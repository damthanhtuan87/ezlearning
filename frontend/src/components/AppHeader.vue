<template>
  <CHeader position="sticky" class="mb-3">
    <CContainer fluid class="d-flex justify-content-between align-items-center">
        <CHeaderToggler class="pt-2 d-xl-none border" @click="commonsStore.toggleSidebar()">
          <CIcon icon="cil-menu" size="lg" />
        </CHeaderToggler>
        <div>
        </div>
        <div>
          <CDropdown in-nav>
            <CDropdownToggle color="primary">
              <CIcon icon="cil-user" />
              {{ conditionalUsersInfo?.name }}
            </CDropdownToggle>
            <CDropdownMenu>
              <CDropdownItem to="/profile">Profile</CDropdownItem>
              <CDropdownItem @click="openConfirmModal()">Logout</CDropdownItem>
            </CDropdownMenu>
          </CDropdown>
          <confirm-modal
            :title="'modals.logout_modal.title'"
            :body-content="'modals.logout_modal.content'"
            :visible="visibleLogoutModal"
            @onClose="visibleLogoutModal = false"
            @leftRoute="handleLogout"
          />
        </div>
    </CContainer>
  </CHeader>
</template>

<script>
import { logo } from '@/assets/brand/logo'
import { useCommonsStore } from '@/store/useCommonsStore'
import ConfirmModal from "@/components/Common/Modal/ConfirmModal.vue";
import {ACCESS_TOKEN_KEY, ACTOR_REDIRECTS} from "@/config/consts";
import {removeUserCookie} from "@/utils/functions";
import {mapState} from "pinia";
export default {
  name: 'AppHeader',
  components: {ConfirmModal},
  data() {
    return {
      visibleLogoutModal: false,
    }
  },
  setup() {
    const commonsStore = useCommonsStore()
    return {
      logo,
      commonsStore
    }
  },
  computed: {
    ...mapState(useCommonsStore, [
      'conditionalUsersInfo',
    ]),
  },
  methods: {
    openConfirmModal() {
      this.visibleLogoutModal = true
    },
    handleLogout() {
      localStorage.removeItem(ACCESS_TOKEN_KEY)
      removeUserCookie()

      // redirect to login
      let pathAccess = localStorage.getItem('pathAccess');
      localStorage.removeItem('pathAccess');
      return window.location.href = ACTOR_REDIRECTS[pathAccess]
    },
  },
}
</script>
