json.array!(@reports) do |report|
  json.extract! report, :id, :status, :location_desc, :phone_number, :photo_url
  json.url report_url(report, format: :json)
end
