class ChangeDatatypeOfLatLng < ActiveRecord::Migration
  def change
  	remove_column 'reports', :location_lat
  	remove_column 'reports', :location_lng
  	add_column 'reports', :location_lng, :string
  	add_column 'reports', :location_lat, :string
  end
end
