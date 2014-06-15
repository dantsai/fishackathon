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

	def self.generate_reg_number
		o = [('A'..'Z'), (0..9)].map { |i| i.to_a }.flatten
		str = (0...8).map { o[rand(o.length)] }.join
	end

	def has_motor_text
		if self.has_motor.nil?
			'Unknown'
		elsif self.has_motor
			'Yes'
		else
			'No'
		end
	end
end
