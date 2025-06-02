function data() {
  function getThemeFromLocalStorage() {

    return false;
  }

  function setThemeToLocalStorage(value) {
    window.localStorage.setItem('dark', false)
  }

  return {
    async checkTokenValidity() {
      try {
        const response = await axios.get(route("api.token.check"));
        console.log(response);
      } catch(e) {
        if(e.status === 401) {
          localStorage.removeItem("token");
          localStorage.removeItem("privileges");
          window.location = route("login");
        }
      }
    },
    async initialize() {
      this.checkTokenValidity();
      if(!localStorage.privileges) {
        const response = await axios.get(route("api.user.privileges"));
        localStorage.setItem("privileges", JSON.stringify(response.data));
      }
      this.privileges = JSON.parse(localStorage.privileges);
      this.fetchingPrivileges = false;
    },
    dark: getThemeFromLocalStorage(),
    hasPrivileges(str) {
      const privileges = this.privileges.filter(privilege => privilege.startsWith(str));
      return privileges.length > 0;
    },
    toggleTheme() {
      this.dark = !this.dark
      setThemeToLocalStorage(this.dark)
    },
    isSideMenuOpen: false,
    toggleSideMenu() {
      this.isSideMenuOpen = !this.isSideMenuOpen
    },
    closeSideMenu() {
      this.isSideMenuOpen = false
    },
    isNotificationsMenuOpen: false,
    toggleNotificationsMenu() {
      this.isNotificationsMenuOpen = !this.isNotificationsMenuOpen
    },
    closeNotificationsMenu() {
      this.isNotificationsMenuOpen = false
    },
    isProfileMenuOpen: false,
    toggleProfileMenu() {
      this.isProfileMenuOpen = !this.isProfileMenuOpen
    },
    closeProfileMenu() {
      this.isProfileMenuOpen = false
    },
    fetchingPrivileges: true,
    privileges: [],
    isPagesMenuOpen: route().current("member.*") && !route().current("member.recovery.*"),
    isRecoveryMenuOpen: route().current("payment-schedule") || route().current("member.recovery.*"),
    isReciprocalMenuOpen: route().current("club.*") || route().current("duration.*") || route().current("introletter.*"),
    isMembershipCardMenuOpen: route().current("card-type.*"),
    isComplainsMenuOpen: route().current("complain.*") || route().current("complains"),
    togglePagesMenu() {
      this.resetAll("PagesMenu");
      this.isPagesMenuOpen = !this.isPagesMenuOpen
    },
    toggleRecoveryMenu() {
      this.resetAll("RecoveryMenu");
      this.isRecoveryMenuOpen = !this.isRecoveryMenuOpen
    },
    toggleReciprocalMenu() {
      this.resetAll("ReciprocalMenu");
      this.isReciprocalMenuOpen = !this.isReciprocalMenuOpen;
    },
    toggleMembershipMenu() {
      this.resetAll("MembershipMenu");
      this.isMembershipCardMenuOpen = !this.isMembershipCardMenuOpen;
    },
    toggleComplainsMenu() {
      this.resetAll("ComplainsMenu");
      this.isComplainsMenuOpen = !this.isComplainsMenuOpen;
    },
    resetAll(type) {
      type === "PagesMenu" ? "" : this.isPagesMenuOpen = false;
      type === "RecoveryMenu" ? "" : this.isRecoveryMenuOpen = false;
      type === "ReciprocalMenu" ? "" : this.isReciprocalMenuOpen = false;
      type === "MembershipMenu" ? "" : this.isMembershipCardMenuOpen = false;
      type === "ComplainsMenu" ? "" : this.isComplainsMenuOpen = false;
    },
    // Modal
    isModalOpen: false,
    trapCleanup: null,
    openModal() {
      this.isModalOpen = true
      this.trapCleanup = focusTrap(document.querySelector('#modal'))
    },
    closeModal() {
      this.isModalOpen = false
      this.trapCleanup()
    },
  }
}
