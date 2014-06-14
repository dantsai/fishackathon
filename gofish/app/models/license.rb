# == Schema Information
#
# Table name: licenses
#
#  id              :integer          not null, primary key
#  status          :integer
#  location_desc   :string(255)
#  registration_id :integer
#  industry_type   :integer
#  fish_type       :integer
#  date_issued     :datetime
#  date_expires    :datetime
#  created_at      :datetime
#  updated_at      :datetime
#


class License < ActiveRecord::Base
	belongs_to :registration

	FISH_TYPES = [ :perch, :halibut, :bass, :grouper, :shellfish ]
end
