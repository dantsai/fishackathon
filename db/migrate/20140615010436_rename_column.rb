class RenameColumn < ActiveRecord::Migration
  def change
  	rename_column :registrations, :location_desc_string, :location_desc
  end
end
