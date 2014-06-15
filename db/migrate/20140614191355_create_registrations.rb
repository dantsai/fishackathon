class CreateRegistrations < ActiveRecord::Migration
  def change
    create_table :registrations do |t|
      t.integer :status
      t.string :location_desc_string
      t.string :name
      t.string :phone_number
      t.string :photo_url
      t.integer :boat_type
      t.string :registration_number

      t.timestamps
    end
  end
end
