json.array!(@registrations) do |registration|
  json.extract! registration, :id, :status, :location_desc_string,, :name, :phone_number, :photo_url, :boat_type, :registration_number
  json.url registration_url(registration, format: :json)
end
