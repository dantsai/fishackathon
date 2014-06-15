class AddBoatName < ActiveRecord::Migration
  def change
  	add_column 'registrations', :boat_name, :string
  end
end
