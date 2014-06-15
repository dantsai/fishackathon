# == Schema Information
#
# Table name: reports
#
#  id            :integer          not null, primary key
#  status        :integer
#  location_desc :string(255)
#  photo_url     :string(255)
#  created_at    :datetime
#  updated_at    :datetime
#  location_lat  :decimal(, )
#  location_lng  :decimal(, )
#

class Report < ActiveRecord::Base
	def self.save_file(upload)
    	name =  upload.original_filename
    	new_name = sanitize_filename(name)
	    directory = "public/data"
	    # create the file path
	    path = File.join(directory, new_name)
	    # write the file
	    File.open(path, 'wb') { |f| f.write(upload.read) }
	    return new_name
  	end

  	def self.sanitize_filename(file_name)
	  # get only the filename, not the whole path (from IE)
	  just_filename = File.basename(file_name) 
	  # replace all none alphanumeric, underscore or perioids
	  # with underscore
	  just_filename.sub(/[^\w\.\-]/,'_') 
	end

	def status_text
		index = self.status || 0
		Enum.REPORT_STATUS[index]
	end

end
