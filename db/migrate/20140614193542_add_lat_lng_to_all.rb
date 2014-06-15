class AddLatLngToAll < ActiveRecord::Migration
  def change
  	add_column :licenses, :location_lat, :decimal
  	add_column :licenses, :location_lng, :decimal
  	add_column :reports, :location_lat, :decimal
  	add_column :reports, :location_lng, :decimal
  	add_column :registrations, :location_lat, :decimal
  	add_column :registrations, :location_lng, :decimal
  end
end
