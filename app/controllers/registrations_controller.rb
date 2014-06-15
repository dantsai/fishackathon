class RegistrationsController < ApplicationController
  before_action :set_registration, only: [:show, :edit, :update, :destroy, :approve]
  skip_before_filter :verify_authenticity_token  
  # GET /registrations
  # GET /registrations.json
  def index
    @registrations = Registration.all
  end

  # GET /registrations/1
  # GET /registrations/1.json
  def show
  end

  # GET /registrations/new
  def new
    @registration = Registration.new
  end

  # GET /registrations/1/edit
  def edit
  end

  def create_from_text
  	puts 'Incoming message for new registration'
  end

  def approve
    @registration = Registration.find(params['id'])
    regstr = ''
    found = false
    while not found 
      regstr = Registration.generate_reg_number
      if not Registration.exists?(:registration_number => regstr)
        found = true
      end
    end  
    @registration.registration_number = regstr
    @registration.status = 2
    @registration.save
    redirect_to registration_path(@registration)
  end



  # POST /registrations
  # POST /registrations.json
  def create
    @registration = Registration.new(registration_params)
    @registration.status = 0

    respond_to do |format|
      if @registration.save
        format.html { redirect_to confirmation_path(type: 'registration') }
        format.json { render action: 'show', status: :created, location: @registration }
      else
        format.html { render action: 'new' }
        format.json { render json: @registration.errors, status: :unprocessable_entity }
      end
    end
  end

  # PATCH/PUT /registrations/1
  # PATCH/PUT /registrations/1.json
  def update
    respond_to do |format|
      if @registration.update(registration_params)
        format.html { redirect_to @registration, notice: 'Registration was successfully updated.' }
        format.json { head :no_content }
      else
        format.html { render action: 'edit' }
        format.json { render json: @registration.errors, status: :unprocessable_entity }
      end
    end
  end

  # DELETE /registrations/1
  # DELETE /registrations/1.json
  def destroy
    @registration.destroy
    respond_to do |format|
      format.html { redirect_to registrations_url }
      format.json { head :no_content }
    end
  end

  private
    # Use callbacks to share common setup or constraints between actions.
    def set_registration
      @registration = Registration.find(params[:id])
    end

    # Never trust parameters from the scary internet, only allow the white list through.
    def registration_params
      params.require(:registration).permit(:status, :location_desc, 
      	:name, :phone_number, :photo_url, :boat_length,
      	:has_motor)
    end
end
