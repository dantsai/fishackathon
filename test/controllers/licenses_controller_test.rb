require 'test_helper'

class LicensesControllerTest < ActionController::TestCase
  setup do
    @license = licenses(:one)
  end

  test "should get index" do
    get :index
    assert_response :success
    assert_not_nil assigns(:licenses)
  end

  test "should get new" do
    get :new
    assert_response :success
  end

  test "should create license" do
    assert_difference('License.count') do
      post :create, license: { date_expires: @license.date_expires, date_issued: @license.date_issued, fish_type: @license.fish_type, industry_type: @license.industry_type, location_desc: @license.location_desc, registration_id: @license.registration_id, status: @license.status }
    end

    assert_redirected_to license_path(assigns(:license))
  end

  test "should show license" do
    get :show, id: @license
    assert_response :success
  end

  test "should get edit" do
    get :edit, id: @license
    assert_response :success
  end

  test "should update license" do
    patch :update, id: @license, license: { date_expires: @license.date_expires, date_issued: @license.date_issued, fish_type: @license.fish_type, industry_type: @license.industry_type, location_desc: @license.location_desc, registration_id: @license.registration_id, status: @license.status }
    assert_redirected_to license_path(assigns(:license))
  end

  test "should destroy license" do
    assert_difference('License.count', -1) do
      delete :destroy, id: @license
    end

    assert_redirected_to licenses_path
  end
end
