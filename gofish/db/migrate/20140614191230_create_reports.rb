class CreateReports < ActiveRecord::Migration
  def change
    create_table :reports do |t|
      t.integer :status
      t.string :location_desc
      t.string :phone_number
      t.string :photo_url

      t.timestamps
    end
  end
end
