class UpdateProperties < ActiveRecord::Migration
  def change
  	remove_column 'licenses', :industry_type
  	add_column 'registrations', :boat_length, :integer
  	add_column 'registrations', :has_motor, :boolean
  end
end
