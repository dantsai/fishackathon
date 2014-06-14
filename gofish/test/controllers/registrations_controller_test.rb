require 'test_helper'

class RegistrationsControllerTest < ActionController::TestCase
  setup do
    @registration = registrations(:one)
  end

  test "should get index" do
    get :index
    assert_response :success
    assert_not_nil assigns(:registrations)
  end

  test "should get new" do
    get :new
    assert_response :success
  end

  test "should create registration" do
    assert_difference('Registration.count') do
      post :create, registration: { boat_type: @registration.boat_type, location_desc_string,: @registration.location_desc_string,, name: @registration.name, phone_number: @registration.phone_number, photo_url: @registration.photo_url, registration_number: @registration.registration_number, status: @registration.status }
    end

    assert_redirected_to registration_path(assigns(:registration))
  end

  test "should show registration" do
    get :show, id: @registration
    assert_response :success
  end

  test "should get edit" do
    get :edit, id: @registration
    assert_response :success
  end

  test "should update registration" do
    patch :update, id: @registration, registration: { boat_type: @registration.boat_type, location_desc_string,: @registration.location_desc_string,, name: @registration.name, phone_number: @registration.phone_number, photo_url: @registration.photo_url, registration_number: @registration.registration_number, status: @registration.status }
    assert_redirected_to registration_path(assigns(:registration))
  end

  test "should destroy registration" do
    assert_difference('Registration.count', -1) do
      delete :destroy, id: @registration
    end

    assert_redirected_to registrations_path
  end
end
