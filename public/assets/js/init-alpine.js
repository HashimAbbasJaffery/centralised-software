function data() {
  function getThemeFromLocalStorage() {
    // if user already changed the theme, use it
    if (window.localStorage.getItem('dark')) {
      return JSON.parse(window.localStorage.getItem('dark'))
    }

    // else return their preferences
    return (
      !!window.matchMedia &&
      window.matchMedia('(prefers-color-scheme: dark)').matches
    )
  }

  function setThemeToLocalStorage(value) {
    window.localStorage.setItem('dark', value)
  }

  return {
    dark: getThemeFromLocalStorage(),
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
    isPagesMenuOpen: route().current("member.*"),
    isRecoveryMenuOpen: false,
    isReciprocalMenuOpen: false,
    isMembershipCardMenuOpen: false,
    isComplainsMenuOpen: false,
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
