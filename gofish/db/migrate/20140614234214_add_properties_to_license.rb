class AddPropertiesToLicense < ActiveRecord::Migration
  def change
  	add_column :licenses, :net_type, :integer
  	add_column :licenses, :hook_line_type, :integer
  	add_column :licenses, :other_gear, :integer
  end
end
