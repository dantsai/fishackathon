# == Schema Information
#
# Table name: reports
#
#  id            :integer          not null, primary key
#  status        :integer
#  location_desc :string(255)
#  phone_number  :string(255)
#  photo_url     :string(255)
#  created_at    :datetime
#  updated_at    :datetime
#

class Report < ActiveRecord::Base
end
