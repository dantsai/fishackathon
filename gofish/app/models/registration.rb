# == Schema Information
#
# Table name: registrations
#
#  id                   :integer          not null, primary key
#  status               :integer
#  location_desc_string :string(255)
#  name                 :string(255)
#  phone_number         :string(255)
#  photo_url            :string(255)
#  boat_type            :integer
#  registration_number  :string(255)
#  created_at           :datetime
#  updated_at           :datetime
#

class Registration < ActiveRecord::Base
	has_many :licenses
	BOAT_TYPES = [ :canoe, :outrigger, :sailboat, :motorboat ]

end
