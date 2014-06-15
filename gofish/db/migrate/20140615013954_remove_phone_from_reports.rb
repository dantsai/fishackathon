class RemovePhoneFromReports < ActiveRecord::Migration
  def change
  	remove_column 'reports', :phone_number
  end
end
