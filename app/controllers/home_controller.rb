class HomeController < ApplicationController
  def index
  end

  def admin
    @licenses_new = License.where('status != 2')
    @licenses_approved = License.where('status = 2')
    @registrations_new = Registration.where('status != 2')
    @registrations_approved = Registration.where('status = 2')
    @reports = Report.all
  end

  def confirmation
  	@type = params['type']
  end

end
