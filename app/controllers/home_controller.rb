class HomeController < ApplicationController
  def index
  end

  def admin
    @licenses = License.where('status = 0').take(10)
    @registrations = Registration.where('status = 0').take(10)
  end

  def confirmation
  	@type = params['type']
  end

end
