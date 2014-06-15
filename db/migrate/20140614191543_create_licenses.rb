class CreateLicenses < ActiveRecord::Migration
  def change
    create_table :licenses do |t|
      t.integer :status
      t.string :location_desc
      t.integer :registration_id
      t.integer :industry_type
      t.integer :fish_type
      t.datetime :date_issued
      t.datetime :date_expires

      t.timestamps
    end
  end
end
