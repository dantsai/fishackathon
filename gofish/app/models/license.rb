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
end
