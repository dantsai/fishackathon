# encoding: UTF-8
# This file is auto-generated from the current state of the database. Instead
# of editing this file, please use the migrations feature of Active Record to
# incrementally modify your database, and then regenerate this schema definition.
#
# Note that this schema.rb definition is the authoritative source for your
# database schema. If you need to create the application database on another
# system, you should be using db:schema:load, not running all the migrations
# from scratch. The latter is a flawed and unsustainable approach (the more migrations
# you'll amass, the slower it'll run and the greater likelihood for issues).
#
# It's strongly recommended that you check this file into your version control system.

ActiveRecord::Schema.define(version: 20140615080851) do

  create_table "licenses", force: true do |t|
    t.integer  "status"
    t.string   "location_desc"
    t.integer  "registration_id"
    t.integer  "fish_type"
    t.datetime "date_issued"
    t.datetime "date_expires"
    t.datetime "created_at"
    t.datetime "updated_at"
    t.decimal  "location_lat"
    t.decimal  "location_lng"
    t.integer  "net_type"
    t.integer  "hook_line_type"
    t.integer  "other_gear"
  end

  create_table "registrations", force: true do |t|
    t.integer  "status"
    t.string   "location_desc"
    t.string   "name"
    t.string   "phone_number"
    t.string   "photo_url"
    t.string   "registration_number"
    t.datetime "created_at"
    t.datetime "updated_at"
    t.decimal  "location_lat"
    t.decimal  "location_lng"
    t.integer  "boat_length"
    t.boolean  "has_motor"
    t.string   "address"
    t.string   "boat_name"
  end

  create_table "reports", force: true do |t|
    t.integer  "status"
    t.string   "location_desc"
    t.string   "photo_url"
    t.datetime "created_at"
    t.datetime "updated_at"
    t.string   "comments"
    t.string   "location_lng"
    t.string   "location_lat"
  end

end
