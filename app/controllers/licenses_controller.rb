class LicensesController < ApplicationController
  before_action :set_license, only: [:show, :edit, :update, :destroy]
  skip_before_filter :verify_authenticity_token 
  
  # GET /licenses
  # GET /licenses.json
  def index
    @licenses = License.all
  end

  # GET /licenses/1
  # GET /licenses/1.json
  def show
  end

  # GET /licenses/new
  def new
    @license = License.new
  end

  # GET /licenses/1/edit
  def edit
  end

  def check_license
    if Registration.exists?('registration_number' => params['regnumber'])
      render json: { "valid" => true} 
    else
      render json: { "valid" => false} 
    end
  end

  def approve
    @license = License.find(params['id'])
    @license.status = 2
    @license.save
    redirect_to license_path(@license)
  end

  # POST /licenses
  # POST /licenses.json
  def create
    @license = License.new(license_params)
    num = params['regnumber']
    puts num
    reg = Registration.where('registration_number' => num).first
    if not reg.nil?
      @license.registration = reg
    end

    license_id = license_params['regnumber']
    #todo: link license to boat registration
    #todo: set the license expiration date
    @license.status = 0

    respond_to do |format|
      if @license.save
        format.html { redirect_to confirmation_path(type: 'license') }
        format.json { render action: 'show', status: :created, location: @license }
      else
        format.html { render action: 'new' }
        format.json { render json: @license.errors, status: :unprocessable_entity }
      end
    end
  end

  # PATCH/PUT /licenses/1
  # PATCH/PUT /licenses/1.json
  def update
    respond_to do |format|
      if @license.update(license_params)
        format.html { redirect_to @license, notice: 'License was successfully updated.' }
        format.json { head :no_content }
      else
        format.html { render action: 'edit' }
        format.json { render json: @license.errors, status: :unprocessable_entity }
      end
    end
  end

  # DELETE /licenses/1
  # DELETE /licenses/1.json
  def destroy
    @license.destroy
    respond_to do |format|
      format.html { redirect_to licenses_url }
      format.json { head :no_content }
    end
  end

  private
    # Use callbacks to share common setup or constraints between actions.
    def set_license
      @license = License.find(params[:id])
    end

    # Never trust parameters from the scary internet, only allow the white list through.
    def license_params
      params.require(:license).permit(:status, :location_desc, 
      	:fish_type, :date_issued, :net_type,
      	:hook_line_type, :other_gear, :date_expires)
    end
end
