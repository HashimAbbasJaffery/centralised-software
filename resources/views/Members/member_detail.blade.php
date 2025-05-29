<x-layout.app>
  <style>
    .iti {
      width: 100%;
    }
    input[type='checkbox'] {
      width: 12px;
      height: 12px;
    }
    .tab-button:hover {
      color: white;
    }
  </style>
  <script src="https://kit.fontawesome.com/3a7e8b6e65.js" crossorigin="anonymous"></script>
  <main id="app" class="h-full pb-16 overflow-y-auto">
    <!-- Remove everything INSIDE this div to a really blank page -->
    <div class="container px-6 mx-auto flex items-center" style="margin-top: 50px;">
      <div>
        <img style="border-radius: 100%; height: 100px; width: 100px;" src="https://gwadargymkhana.com.pk/members/storage/{{ $member->profile_picture }}"/>
      </div>
      <div style="margin-left: 10px;">
        <h1 style="font-size: 20px; font-weight: bold;">{{ $member->member_name }}</h1>
        <p style="margin-bottom: 5px; font-size: 13px; font-style: italic;">{{ $member->membership->card_name }} Membership</p>
        @if($member->membership_status === "regular")
          <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-green-900 dark:text-green-300 p-1 px-2 rounded-md">Regular</span>
        @else
          <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-red-900 dark:text-red-300 p-1 px-2 rounded-md">{{ $member->membership_status }}</span>
        @endif
      </div>
    </div>
    <div class="container px-6 mx-auto" style="margin-top: 50px; display: flex; column-gap: 40px;">
            <!-- Sidebar Tabs -->
      <div class="tabs">
        <div style="margin-bottom: 20px;">
          <button @click="tab = 'personal information'" :class="{'bg-purple-600 text-white': tab === 'personal information'}" style="width: 170px; text-align: left;" class="tab-button px-3 py-1 text-sm font-medium leading-5 transition-colors duration-150 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            Personal Information
          </button>
        </div>

        <div @click="tab = 'contact information'" style="margin-bottom: 20px;">
          <button style="width: 170px; text-align: left;" :class="{'bg-purple-600 text-white': tab === 'contact information'}" class="tab-button px-3 py-1 text-sm font-medium leading-5 transition-colors duration-150 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            Contact Information
          </button>
        </div>

        <div @click="tab = 'membership information'" style="margin-bottom: 20px;">
          <button style="width: 170px; text-align: left;" :class="{'bg-purple-600 text-white': tab === 'membership information'}" class="tab-button px-3 py-1 text-sm font-medium leading-5 transition-colors duration-150 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            Membership
          </button>
        </div>

        <div @click="tab = 'payment information'" style="margin-bottom: 20px;">
          <button style="width: 170px; text-align: left;" :class="{'bg-purple-600 text-white': tab === 'payment information'}" class="tab-button px-3 py-1 text-sm font-medium leading-5 transition-colors duration-150 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            Payments
          </button>
        </div>

        <div @click="tab = 'locker information'" style="margin-bottom: 20px;">
          <button style="width: 170px; text-align: left;" :class="{'bg-purple-600 text-white': tab === 'locker information'}" class="tab-button px-3 py-1 text-sm font-medium leading-5 transition-colors duration-150 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            Locker
          </button>
        </div>
      </div>
      <div v-if="tab === 'personal information'">
        <p><span style="display: inline-block; width: 200px;">Name:</span> <span editable="true">{{ $member->member_name }}</span></p>
        <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">Date of Birth:</span> {{ \Carbon\Carbon::parse($member->date_of_birth)->format("d-M-Y") }}</p>
        <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px; text-transform: capitalize;">Gender:</span> {{ $member->gender }}</p>
        <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px; text-transform: capitalize;">Marital Status:</span> {{ $member->marital_status }}</p>
        <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">CNIC/Passport:</span> {{ $member->cnic_passport }}</p>
        <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">City/Country:</span> {{ $member->city_country }}</p>
        <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">Blood Group:</span> <span style="text-transform: uppercase;">{{ $member->blood_group }}</span></p>
      </div>
      <div v-if="tab === 'contact information'">
        <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">Phone Number:</span> {{ $member->phone_number }}</p>
        <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">Alternate Phone Number:</span> {{ $member->alternate_ph_number }}</p>
        <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">Emergency Number:</span> {{ $member->emergency_contact }}</p>
        <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">Email Address:</span> {{ $member->email_address }}</p>
      </div>
      <div v-if="tab === 'membership information'">
        <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">Membership Type:</span> {{ $member->membership->card_name }}</p>
        <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">Membership Number:</span> {{ $member->membership_number }}</p>
        <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">Membership Status:</span> {{ $member->membership_status }}</p>
        <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">Card Type:</span> {{ $member->card_type }}</p>
        <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">Date of Issue(Card):</span> {{ \Carbon\Carbon::parse($member->date_of_issue)->format("d-M-Y") }}</p>
        <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">Validity(Card):</span> {{ \Carbon\Carbon::parse($member->validity)->format("d-M-Y") }}</p>
        <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">Date of Applying:</span> {{ \Carbon\Carbon::parse($member->date_of_applying)->format("d-M-Y") }}</p>
      </div>
      <div v-if="tab === 'payment information'">
        <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">File Number:</span> {{ $member->file_number }}</p>
        <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">Form Fee:</span> {{ number_format($member->form_fee) }}/-</p>
        <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">Processing Fee:</span> {{ number_format($member->processing_fee) }}/-</p>
        <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">First Payment:</span> {{ number_format($member->first_payment) }}/-</p>
        <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">Total Installment:</span> {{ number_format($member->total_installment) }}/-</p>
        <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">Installment Month:</span> {{ $member->installment_month }}</p>
        <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">Total:</span> {{ number_format($member->form_fee + $member->processing_fee + $member->first_payment + $member->total_installment) }}/-</p>
        <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">Payment Status:</span> {{ $member->payment_status }}</p>
      </div>
      <div v-if="tab === 'locker information'">
        <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">Locker Category:</span> <span style="text-transform: uppercase;">{{ $member->locker_category }}</span></p>
        <p style="margin-top: 10px;"><span style="display: inline-block; width: 200px;">Locker Number:</span> {{ $member->locker_number }}</p>
      </div>
    </div>
  </main>
   
  <script>
    const app = Vue.createApp({
      data() {
        return {
          tab: "personal information"
        }
      }
    }).mount("#app");
  </script>
</x-layout.app>

