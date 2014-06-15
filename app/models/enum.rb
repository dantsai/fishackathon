class Enum < ActiveRecord::Base
	
	def self.FISH_TYPES
		[ 'Small', 'Large' ]
	end

	def self.LINE_TYPES
		[ 'Longline', 'Bottom Longline', 'Handline' ]
	end

	def self.NET_TYPES 
		['Bottom Trawl', 'Midwater Trawl','Gillnet', 'Purse Seine: FAD',
		 'Purse Seine: FAD Free']
	end

	def self.OTHER_GEAR_TYPES
		['Dredge', 'Trap', 'Hand Methods', 'None']
	end

  	def self.REQUEST_STATUS 
  		['Waiting for Payment', 'Incomplete', 'Approved']
  	end

  	def self.REPORT_STATUS 
  		['New', 'Investigating', 'Resolved']
  	end

end