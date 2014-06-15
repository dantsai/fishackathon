# == Schema Information
#
# Table name: licenses
#
#  id              :integer          not null, primary key
#  status          :integer
#  location_desc   :string(255)
#  registration_id :integer
#  fish_type       :integer
#  date_issued     :datetime
#  date_expires    :datetime
#  created_at      :datetime
#  updated_at      :datetime
#  location_lat    :decimal(, )
#  location_lng    :decimal(, )
#  net_type        :integer
#  hook_line_type  :integer
#  other_gear      :integer
#

class License < ActiveRecord::Base
	belongs_to :registration

	def status_text
		index = self.status || 0
		Enum.REQUEST_STATUS[index]
	end

	def fish_type_text
		index = self.fish_type
		Enum.FISH_TYPES[index]
	end

	def regnumber
		if self.registration.nil?
			'None'
		else
			self.registration.registration_number
		end
	end

	def line_text
		index = self.hook_line_type
		Enum.LINE_TYPES[index]
	end

	def fisher_name
		if self.registration.nil?
			'Unknown'
		else
			self.registration.name
		end
	end

	def fisher_phone
		if self.registration.nil?
			 'Unknown'
		else
			self.registration.phone_number
		end
	end
end
