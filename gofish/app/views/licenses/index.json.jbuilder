json.array!(@licenses) do |license|
  json.extract! license, :id, :status, :location_desc, :registration_id, :industry_type, :fish_type, :date_issued, :date_expires
  json.url license_url(license, format: :json)
end
