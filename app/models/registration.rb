# == Schema Information
#
# Table name: registrations
#
#  id                  :integer          not null, primary key
#  status              :integer
#  location_desc       :string(255)
#  name                :string(255)
#  phone_number        :string(255)
#  photo_url           :string(255)
#  boat_type           :integer
#  registration_number :string(255)
#  created_at          :datetime
#  updated_at          :datetime
#  location_lat        :decimal(, )
#  location_lng        :decimal(, )
#  boat_length         :integer
#  has_motor           :boolean
#

class Registration < ActiveRecord::Base
	has_many :licenses

	def status_text
		index = self.status || 0
		Enum.REQUEST_STATUS[index]
	end
end
