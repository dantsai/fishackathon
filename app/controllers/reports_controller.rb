class ReportsController < ApplicationController
  before_action :set_report, only: [:show, :edit, :update, :destroy]
  skip_before_filter :verify_authenticity_token 

  # GET /reports
  # GET /reports.json
  def index
    @reports = Report.all
  end

  # GET /reports/1
  # GET /reports/1.json
  def show
  end

  # GET /reports/new
  def new
    @report = Report.new
  end

  # GET /reports/1/edit
  def edit
  end

  def resolve
    @report = Report.find(params['id'])
    @report.status = 2
    @report.save
    redirect_to report_path(@report)
  end

  def create_from_text
    @report = Report.new
    @report.location_desc = params['location']
    @report.comments = params['comment'] + ' BOAT ID:' + params['regID']
    @report.save
    render json: {'id' => @report.id }
  end

  # POST /reports
  # POST /reports.json
  def create
    @report = Report.new(report_params)
    uploaded_report_path = Report.save_file(report_params[:photo_url])
    @report.photo_url = uploaded_report_path

    #todo: set report status

    respond_to do |format|
      if @report.save
        format.html { redirect_to confirmation_path(type: 'report') }
        format.json { render action: 'show', status: :created, location: @report }
      else
        format.html { render action: 'new' }
        format.json { render json: @report.errors, status: :unprocessable_entity }
      end
    end
  end

  # PATCH/PUT /reports/1
  # PATCH/PUT /reports/1.json
  def update
    respond_to do |format|
      if @report.update(report_params)
        format.html { redirect_to @report, notice: 'Report was successfully updated.' }
        format.json { head :no_content }
      else
        format.html { render action: 'edit' }
        format.json { render json: @report.errors, status: :unprocessable_entity }
      end
    end
  end

  # DELETE /reports/1
  # DELETE /reports/1.json
  def destroy
    @report.destroy
    respond_to do |format|
      format.html { redirect_to reports_url }
      format.json { head :no_content }
    end
  end

  private
    # Use callbacks to share common setup or constraints between actions.
    def set_report
      @report = Report.find(params[:id])
    end

    # Never trust parameters from the scary internet, only allow the white list through.
    def report_params
      params.require(:report).permit(:status, :location_desc, :phone_number, 
      	:photo_url, :location_lat, :location_lng, :comments)
    end
end
