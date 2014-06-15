class DropBoatType < ActiveRecord::Migration
  def change
  	remove_column 'registrations', :boat_type
  	add_column 'registrations', :address, :string
  end
end
