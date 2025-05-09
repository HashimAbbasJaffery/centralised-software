<x-layout.app>
        <style>
          .iti {
            width: 100%;
          }
        </style>
        <main id="app" class="h-full pb-16 overflow-y-auto">
          <!-- Remove everything INSIDE this div to a really blank page -->
          <div class="container px-6 mx-auto grid">
            <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
              Create Member
            </h2>
            <div v-show="current_step === 1" class="step-form px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
              <h5 style="margin-bottom: 20px;" class="dark:text-gray-200">Personal Information</h5>
              <div style="display: flex; column-gap: 20px;">
                <div style="width: 33.33%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Member's name</span>
                    <input v-model="member_name" data-message="member_field_message" class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="shahmir ahsanullah">
                    <span style="display: none;" class="member_field_message text-xs text-red-600 dark:text-red-400">
                      Member's field is required
                    </span>
                  </label>
                </div>
                <div style="width: 33.33%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Date of Birth</span>
                    <input v-model="date_of_birth" data-message="date_of_birth_field_message" type="date" class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="shahmir ahsanullah">
                    <span style="display: none;" class="date_of_birth_field_message step_1_message text-xs text-red-600 dark:text-red-400">
                      Date of Birth field is required
                    </span>
                  </label>
                </div>
                <div style="width: 33.33%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">CNIC/Passport</span>
                    <input v-model="cnic" data-message="cnic_field_message" class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="XXXX-XXXXXXX-X">
                    <span style="display: none;" class="cnic_field_message step_1_message text-xs text-red-600 dark:text-red-400">
                      CNIC/Passport field is required
                    </span>
                  </label>
                </div>
              </div>
              <div style="display: flex; column-gap: 20px;">
                <div style="width: 50%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Gender</span>
                    <select v-model="gender" data-message="gender_field_message" class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
                      <option value="male">Male</option>
                      <option value="female">Female</option>
                    </select>
                    <span style="display: none;" class="gender_field_message step_1_message text-xs text-red-600 dark:text-red-400">
                      Gender field is required
                    </span>
                  </label>
                </div>
                <div style="width: 50%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Marital Status</span>
                    <select v-model="marital_status" data-message="marital_field_message" class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
                      <option value="single">Single</option>
                      <option value="married">Married</option>
                      <option value="divorced">Divorced</option>
                    </select>
                    <span style="display: none;" class="marital_field_message step_1_message text-xs text-red-600 dark:text-red-400">
                      Marital field is required
                    </span>
                  </label>
                </div>
              </div>
              <div style="display: flex; justify-content: center;">
                <div v-for="step in total_steps" class="step bg-purple-600" :style="{ 'background': step <= current_step ? '' : 'gray' }" style="width: 5px; height: 5px; border-radius: 100%; margin-right: 5px;">&nbsp;</div>
              </div>
            </div>
            <div v-show="current_step === 2" class="step-form px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
              <h5 style="margin-bottom: 20px;" class="dark:text-gray-200">Contact Details</h5>
              <div style="display: flex; column-gap: 20px;">
                <div style="width: 33.33%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400" style="margin-bottom: 20px;">Phone</span>
                    <br>
                    <input style="width: 100% !important; margin-top: 4px !important;" v-model="phone" data-message="phone_field_message" class="phone step_2 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Phone Number">
                    <span style="display: none;" class="phone_field_message text-xs text-red-600 dark:text-red-400">
                      Phone number field is required
                    </span>
                  </label>
                </div>
                <div style="width: 33.33%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Alternate Phone Number</span>
                    <input v-model="alt_phone_number" style="width: 100% !important; margin-top: 4px !important;" id="alt_phone_number" data-message="alt_ph_number_field_message" type="text" class="phone step_2 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Alternate Phone Number">
                    <span style="display: none;" class="alt_ph_number_field_message step_1_message text-xs text-red-600 dark:text-red-400">
                      Alternate Phone Number field is required
                    </span>
                  </label>
                </div>
                <div style="width: 33.33%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Email</span>
                    <input v-model="email" type="email" style="width: 100% !important; margin-top: 4px !important;" data-message="email_message" class="step_2 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="example@example.com">
                    <span style="display: none;" class="email_message step_1_message text-xs text-red-600 dark:text-red-400">
                      Email field is required
                    </span>
                  </label>
                </div>
              </div>
              <div style="display: flex; column-gap: 20px;">
                <div style="width: 50%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Residential Address</span>
                    <input v-model="residential_address" type="text" style="width: 100% !important; margin-top: 4px !important;" data-message="residential_address_message" class="step_2 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Residential Address">
                    <span style="display: none;" class="residential_address_message step_2_message text-xs text-red-600 dark:text-red-400">
                      Residential Address field is required
                    </span>
                  </label>
                </div>
                <div style="width: 50%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">City/Country</span>
                    <input v-model="city_country" type="text" style="width: 100% !important; margin-top: 4px !important;" data-message="city_country_message" class="step_2 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Residential Address">
                    <span style="display: none;" class="city_country_message step_1_message text-xs text-red-600 dark:text-red-400">
                      City/Country field is required
                    </span>
                  </label>
                </div>
              </div>
              <div style="display: flex; justify-content: center;">
                <div v-for="step in total_steps" class="step bg-purple-600" :style="{ 'background': step <= current_step ? '' : 'gray' }" style="width: 5px; height: 5px; border-radius: 100%; margin-right: 5px;">&nbsp;</div>
              </div>
            </div>
            <div v-show="current_step === 3" class="step-form px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
              <h5 style="margin-bottom: 20px;" class="dark:text-gray-200">Membership Details</h5>
              <div style="display: flex; column-gap: 20px;">
                <div style="width: 33.33%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Membership Type</span>
                    <select v-model="membership_type" data-message="membership_type_field_message" class="step_3 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
                      <option value="permanent">Permanent</option>
                      <option value="permanent+">Permanent+</option>
                      <option value="founder">Founder</option>
                      <option value="corporate-applicant">Corporate Applicant</option>
                      <option value="permanent se">Permanent SE</option>
                      <option value="temporary">Temporary</option>
                    </select>
                    <span style="display: none;" class="membership_type_field_message step_3_message text-xs text-red-600 dark:text-red-400">
                      Membership Type is required
                    </span>
                  </label>
                </div>
                <div style="width: 33.33%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Membership Status</span>
                    <select v-model="membership_status" data-message="membership_type_field_message" class="step_3 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
                      <option value="regular">Regular</option>
                      <option value="defaulter">Defaulter</option>
                      <option value="cancelled">Cancelled</option>
                    </select>
                    <span style="display: none;" class="member_number_message step_1_message text-xs text-red-600 dark:text-red-400">
                      Card Type field is required
                    </span>
                  </label>
                </div>
                <div style="width: 33.33%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">File Number</span>
                    <input v-model="file_number" type="text" style="width: 100% !important; margin-top: 4px !important;" data-message="email_message" class="step_3 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="File Number">
                    <span style="display: none;" class="email_message step_1_message text-xs text-red-600 dark:text-red-400">
                      File Number field is required
                    </span>
                  </label>
                </div>
              </div>
              <div style="display: flex; column-gap: 20px;">
                <div style="width: 50%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Date of Applying</span>
                    <input v-model="date_of_applying" type="date" style="width: 100% !important; margin-top: 4px !important;" data-message="date_of_applying_message" class="step_3 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Residential Address">
                    <span style="display: none;" class="date_of_applying_message step_1_message text-xs text-red-600 dark:text-red-400">
                      Date of Applying field is required
                    </span>
                  </label>
                </div>
                <div style="width: 50%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Membership Number</span>
                    <input v-model="membership_number" type="text" style="width: 100% !important; margin-top: 4px !important;" data-message="membership_number_message" class="step_3 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Membership Number">
                    <span style="display: none;" class="membership_number_message step_1_message text-xs text-red-600 dark:text-red-400">
                      Membership Number field is required
                    </span>
                  </label>
                </div>
              </div>
              <div style="display: flex; justify-content: center;">
                <div v-for="step in total_steps" class="step bg-purple-600" :style="{ 'background': step <= current_step ? '' : 'gray' }" style="width: 5px; height: 5px; border-radius: 100%; margin-right: 5px;">&nbsp;</div>
              </div>
            </div>
            <div v-show="current_step === 4" class="step-form px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
              <h5 style="margin-bottom: 20px;" class="dark:text-gray-200">Spouse Information</h5>
              <div style="display: flex; column-gap: 20px;">
                <div style="width: 50%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">First Spouse</span>
                    <input v-model="spouses[0]" type="text" style="width: 100% !important; margin-top: 4px !important;" data-message="email_message" class="optional step_4 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="First Spouse">
                  </label>
                </div>
                <div style="width: 50%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Second Spouse</span>
                    <input v-model="spouses[1]" type="text" style="width: 100% !important; margin-top: 4px !important;" data-message="email_message" class="optional step_4 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Second Spouse">
                  </label>
                </div>
              </div>
              <div style="display: flex; column-gap: 20px;">
                <div style="width: 50%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Third Spouse</span>
                    <input v-model="spouses[2]" type="text" style="width: 100% !important; margin-top: 4px !important;" data-message="email_message" class="optional step_4 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Third Spouse">
                  </label>
                </div>
                <div style="width: 50%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Fourth Spouse</span>
                    <input v-model="spouses[3]" type="text" style="width: 100% !important; margin-top: 4px !important;" data-message="email_message" class="optional step_4 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Fourth Spouse">
                  </label>
                </div>
              </div>
              <div style="display: flex; justify-content: center;">
                <div v-for="step in total_steps" class="step bg-purple-600" :style="{ 'background': step <= current_step ? '' : 'gray' }" style="width: 5px; height: 5px; border-radius: 100%; margin-right: 5px;">&nbsp;</div>
              </div>
            </div>
            <div v-show="current_step === 5" class="step-form px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
              <h5 style="margin-bottom: 20px;" class="dark:text-gray-200">Children Information</h5>
              <div v-for="child in children" style="display: flex; column-gap: 20px; align-items: center;">
                <div style="width: 49%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400" style="text-transform: capitalize;" v-text="`${numberToOrdinal(child.id)} child`"></span>
                    <input v-model="child.childName" type="text" style="width: 100% !important; margin-top: 4px !important;" data-message="email_message" class="optional step_5 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" :placeholder="`${numberToOrdinal(child.id)} child`">
                  </label>
                </div>
                <div style="width: 49%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400" v-text="`${numberToOrdinal(child.id)} child date of birth`"></span>
                    <input v-model="child.dob" type="date" style="width: 100% !important; margin-top: 4px !important;" data-message="email_message" class="optional step_5 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" :placeholder="`${numberToOrdinal(child.id)} child date of birth`">
                  </label>
                </div>
                <div class="actions" style="display: flex; column-gap: 10px;">
                  <button @click="addNewChild" class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    +
                  </button>
                  <button @click="deleteChild(child.id)" class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    -
                  </button>
                </div>
              </div>              
              <div style="display: flex; justify-content: center;">
                <div v-for="step in total_steps" class="step bg-purple-600" :style="{ 'background': step <= current_step ? '' : 'gray' }" style="width: 5px; height: 5px; border-radius: 100%; margin-right: 5px;">&nbsp;</div>
              </div>
            </div>
            <div v-show="current_step === 6" class="step-form px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
              <h5 style="margin-bottom: 20px;" class="dark:text-gray-200">Financial Details</h5>
              <div style="display: flex; column-gap: 20px;">
                <div style="width: 33.33%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Form Fee</span>
                    <input type="text" v-model="form_fee" style="width: 100% !important; margin-top: 4px !important;" data-message="email_message" class="optional step_4 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Form Fee">
                  </label>
                </div>
                <div style="width: 33.33%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Processing Fee</span>
                    <input type="text" v-model="processing_fee" style="width: 100% !important; margin-top: 4px !important;" data-message="email_message" class="optional step_4 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Processing Fee">
                  </label>
                </div>
                <div style="width: 33.33%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">First Payment</span>
                    <input type="text" v-model="first_payment" style="width: 100% !important; margin-top: 4px !important;" data-message="email_message" class="optional step_4 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="First Payment">
                  </label>
                </div>
              </div>
              <div style="display: flex; column-gap: 20px;">
                <div style="width: 33.33%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Total Installment</span>
                    <input type="text" v-model="total_installment" style="width: 100% !important; margin-top: 4px !important;" data-message="email_message" class="optional step_4 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Total Installment">
                  </label>
                </div>
                <div style="width: 33.33%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Installment Month</span>
                    <input type="text" v-model="installment_month" style="width: 100% !important; margin-top: 4px !important;" data-message="email_message" class="optional step_4 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Installment Month">
                  </label>
                </div>
                <div style="width: 33.33%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Sum</span>
                    <input type="text" :value="totalSum" readonly style="width: 100% !important; margin-top: 4px !important;" data-message="email_message" class="optional step_4 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Sum">
                  </label>
                </div>
              </div>
              <div style="display: flex; justify-content: center;">
                <div v-for="step in total_steps" class="step bg-purple-600" :style="{ 'background': step <= current_step ? '' : 'gray' }" style="width: 5px; height: 5px; border-radius: 100%; margin-right: 5px;">&nbsp;</div>
              </div>
            </div>
            <div v-show="current_step === 7" class="step-form px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
              <h5 style="margin-bottom: 20px;" class="dark:text-gray-200">Emergency and Health Information</h5>
              <div style="display: flex; column-gap: 20px;">
                <label class="block text-sm" style="margin-bottom: 20px; width: 50%">
                  <span class="text-gray-700 dark:text-gray-400">Blood Group</span>
                  <select v-model="blood_group" data-message="marital_field_message" class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
                    <option value="a+">A+</option>
                    <option value="a-">A-</option>
                    <option value="b+">B+</option>
                    <option value="b-">B-</option>
                    <option value="ab+">AB+</option>
                    <option value="ab-">AB-</option>
                    <option value="o+">O+</option>
                    <option value="o-">O-</option>
                  </select>
                  <span style="display: none;" class="marital_field_message step_1_message text-xs text-red-600 dark:text-red-400">
                    Marital field is required
                  </span>
                </label>
                <div style="width: 50%;">
                  <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Emergency Contact</span>
                    <input type="text" v-model="emergency_contact" style="width: 100% !important; margin-top: 4px !important;" data-message="emergency_contact" class="phone step_7 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Emergency Contact">
                  </label>
                  <span style="display: none;" class="emergency_contact text-xs text-red-600 dark:text-red-400">
                    Emergency Contact field is required
                  </span>
                </div>
              </div>
              <div style="display: flex; justify-content: center;">
                <div v-for="step in total_steps" class="step bg-purple-600" :style="{ 'background': step <= current_step ? '' : 'gray' }" style="width: 5px; height: 5px; border-radius: 100%; margin-right: 5px;">&nbsp;</div>
              </div>
            </div>
            <div v-show="current_step === 8" class="step-form px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
              <h5 style="margin-bottom: 20px;" class="dark:text-gray-200">Membership Card Details</h5>
              <div style="display: flex; column-gap: 20px;">
                <div style="width: 50%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Profile Picture</span>
                    <input type="file" style="width: 100% !important; margin-top: 4px !important;" data-message="email_message" class="optional step_4 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Profile Picture">
                  </label>
                </div>
                <label class="block text-sm" style="margin-bottom: 20px; width: 50%">
                  <span class="text-gray-700 dark:text-gray-400">Card Type</span>
                  <select v-model="card_type" data-message="marital_field_message" class="step_8 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
                    <option value="Provisional Membership">Provisional Membership</option>
                    <option value="cleared">Cleared</option>
                  </select>
                </label>
              </div>
              <div style="display: flex; column-gap: 20px;">
                <div style="width: 50%;">
                  <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Date of Issue</span>
                    <input type="date" style="width: 100% !important; margin-top: 4px !important;" data-message="date_of_issue" class="step_8 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Profile Picture">
                  </label>
                  <span style="display: none;" class="date_of_issue text-xs text-red-600 dark:text-red-400">
                    Date of Issue field is required
                  </span>
                </div>
                <div style="width: 50%;">
                  <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Validity</span>
                    <input type="date" style="width: 100% !important; margin-top: 4px !important;" data-message="validity_message" class="step_8 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Profile Picture">
                  </label>
                  <span style="display: none;" class="validity_message text-xs text-red-600 dark:text-red-400">
                    Validity field is required
                  </span>
                  <div style="margin-bottom: 20px;">&nbsp;</div>
                </div>
              </div>
              <div style="display: flex; justify-content: center;">
                <div v-for="step in total_steps" class="step bg-purple-600" :style="{ 'background': step <= current_step ? '' : 'gray' }" style="width: 5px; height: 5px; border-radius: 100%; margin-right: 5px;">&nbsp;</div>
              </div>
            </div>
            <div v-show="current_step === 9" class="step-form px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
              <h5 style="margin-bottom: 20px;" class="dark:text-gray-200">Locker Details</h5>
              <div style="display: flex; column-gap: 20px;">
                <div style="width: 50%;">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Locker Category</span>
                    <select v-model="locker_category" data-message="marital_field_message" class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
                      <option value="a">A</option>
                      <option value="b">B</option>
                      <option value="c">C</option>
                      <option value="d">D</option>
                      <option value="e">E</option>
                      <option value="f">F</option>
                    </select>
                    <span style="display: none;" class="marital_field_message step_1_message text-xs text-red-600 dark:text-red-400">
                      Marital field is required
                    </span>
                  </label>
                </div>
                <label class="block text-sm" style="margin-bottom: 20px; width: 50%">
                  <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Locker Number</span>
                    <input type="text" v-model="locker_number" style="width: 100% !important; margin-top: 4px !important;" data-message="email_message" class="optional step_4 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Locker Number">
                  </label>
              </div>
              <div style="display: flex; justify-content: center;">
                <div v-for="step in total_steps" class="step bg-purple-600" :style="{ 'background': step <= current_step ? '' : 'gray' }" style="width: 5px; height: 5px; border-radius: 100%; margin-right: 5px;">&nbsp;</div>
              </div>
            </div>
            <div style="display: flex; column-gap: 10px;">
              <button @click="previous" :disabled="current_step < 2" style="background: #1f2937;" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-700 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Previous
              </button>
              <button v-if="current_step < total_steps" @click="next" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Next
              </button>
              <button @click="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" v-else>
                Submit
              </button>
            </div>
          </div>
          
        </main>
        <script>
          const app = Vue.createApp({
            data() {
              return {
                current_step: 1,
                total_steps: 4,

                member_name: "",
                date_of_birth: "",
                cnic: "",
                gender: "male",
                marital_status: "married",

                phone: "",
                alt_phone_number: "",
                email: "",
                residential_address: "",
                city_country: "",

                membership_type: "permanent",
                membership_number: "",
                membership_status: "regular",
                file_number: "",
                date_of_applying: "",

                spouses: [[], [], [], []],
                children: [{id: 1, childName: "", dob: ""}],

                form_fee: "",
                processing_fee: "",
                first_payment: "",
                total_installment: "",
                installment_month: "",

                blood_group: "a+",
                emergency_contact: "",

                card_type: "Provisional Membership",

                locker_category: "a",
                locker_number: ""
              }
            },
            computed: {
              totalSum() {
                let total = 0;
                if(this.form_fee && typeof parseInt(this.form_fee) === "number") total += parseInt(this.form_fee);
                if(this.processing_fee && typeof parseInt(this.processing_fee) === "number") total += parseInt(this.processing_fee);
                if(this.first_payment && typeof parseInt(this.first_payment) === "number") total += parseInt(this.first_payment);
                if(this.total_installment && typeof parseInt(this.total_installment) === "number") total += parseInt(this.total_installment);
                return new Intl.NumberFormat().format(total);
              }
            },
            methods: {
              validate_inputs() {
                const inputs = document.querySelectorAll(`.step_${this.current_step}:not(.optional)`);
                console.log(inputs);
                let doesntHaveErrors = true;

                inputs.forEach(input => {
                  const message = document.querySelector(`.${input.dataset.message}`);
                  
                  if(!input.value) {
                    message.style.display = "block";
                    input.classList.add("block", "w-full", "mt-1", "text-sm", "border-red-600", "dark:text-gray-300", "dark:bg-gray-700", "focus:border-red-400", "focus:outline-none", "focus:shadow-outline-red", "form-input");
                    doesntHaveErrors = false;
                  } else {
                    input.classList.remove("border-red-600");
                    message.style.display = "none";
                  }
                });

                return doesntHaveErrors;
              },
              next() {
                if(!this.validate_inputs()) return;
                this.current_step++;
              },
              previous() {
                this.current_step--;
              },
              addNewChild() {
                this.children.push({ id: this.children.length + 1, childName: "", dob: "" });
              },
              numberToOrdinal(n) {
                  const ordinals = ['First', 'Second', 'Third', 'Fourth', 'Fifth', 'Sixth', 'Seventh', 'Eighth', 'Ninth', 'Tenth'];
                  if (n >= 1 && n <= ordinals.length) {
                    return ordinals[n - 1];
                  }

                  // Fallback for numbers > 10
                  const suffixes = ['th', 'st', 'nd', 'rd'];
                  const v = n % 100;
                  const suffix = suffixes[(v - 20) % 10] || suffixes[v] || suffixes[0];
                  return n + suffix;
              },
              normalizeIds() {
                this.children.forEach((child, index) => {
                  child.id = index + 1;
                })
              },
              deleteChild(id) {
                this.children = this.children.filter(child => child.id !== id);
                this.normalizeIds();
              },
              submit() {
                console.log("Form will be submitted!");
              }
            },
            mounted() {
              const stepForms = document.querySelectorAll(".step-form");
              this.total_steps = stepForms.length;


              const input = document.querySelector("#phone");
              const inputs = document.querySelectorAll(".phone");

              inputs.forEach(input => {
                const iti = window.intlTelInput(input, {
                  loadUtils: () => import("https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/js/utils.js"),
                });
              });

                const phones = document.querySelectorAll(".phone")
                
                const updatePhoneNumber = () => {
                  // const countryData = iti.getSelectedCountryData();
                  // const country_code = document.getElementById("country_code");
                  // const phone_number = document.getElementById("phone_number");
                  // country_code.value = countryData.dialCode;
                  // phone_number.value = iti.getNumber().replace(/^\+/, '');
                }

                inputs.forEach(input => {
                  input.addEventListener("countrychange", function () {
                      updatePhoneNumber();
                  });
                });
                
                phones.forEach(phone => {
                  phone.addEventListener("input", function() {
                      updatePhoneNumber();
                  })
                })
            }
          }).mount("#app");
        </script>
</x-layout.app>

