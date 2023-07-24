<template>
  <div>
    <MainLayout>
      <CCardHeader>
        <strong v-if="!isEditScreen()">{{ $t('courses.title_create') }}</strong>
        <strong v-else>{{ $t('courses.title_update') }}</strong>
      </CCardHeader>
      <CCardBody>
        <form class="padding-form">
          <vee-form @submit="handleSubmit">
            <div class="w-60 w-md-100 form-wrapper">
              <CRow class="mb-3">
                <CCol :lg="configs.grids.label" :xs="configs.grids.xs">
                  <label class="form-label">
                    {{ $t('courses.name') }}<span class="required">*</span>
                  </label>
                </CCol>
                <CCol :lg="configs.grids.input" :xs="configs.grids.xs">
                  <vee-field
                    id="name"
                    name="name"
                    class="form-control"
                    type="text"
                    maxlength="255"
                    v-model="entry.name"
                    rules="required"
                    label="courses.name"
                  />
                  <ErrorMessage name="name" />
                </CCol>
              </CRow>
              <CRow class="mb-3">
                <CCol :lg="configs.grids.label" :xs="configs.grids.xs">
                  <label class="form-label">
                    {{ $t('courses.description')
                    }}<span class="required">*</span>
                  </label>
                </CCol>
                <CCol :lg="configs.grids.input" :xs="configs.grids.xs">
                  <vee-field
                    id="description"
                    name="description"
                    class="form-control"
                    as="textarea"
                    rows="4"
                    type="text"
                    maxlength="255"
                    v-model="entry.descriptions"
                    rules="required"
                    label="courses.description"
                  />
                  <ErrorMessage name="description" />
                </CCol>
              </CRow>
              <div
                class="subDatatableContainer mt-3"
                style="
                   {
                    height: 100%;
                  }
                "
              >
                <CCol>
                  <CButton
                    class="btn-right mb-3"
                    type="button"
                    color="primary"
                    variant="outline"
                    id="button-addon2"
                    @click="openSelectedUserModal()"
                  >
                    {{ $t('buttons.add_user') }}
                  </CButton>
                </CCol>
                <div
                  class="subDatatableWrapper"
                  style="
                     {
                      width: 100%;
                    }
                  "
                >
                  <CTable hover bordered>
                    <CTableHead class="subThead">
                      <CTableRow>
                        <CTableHeaderCell class="text-center" style="width: 3%"
                          >{{ $t('common.label_column_no') }}
                        </CTableHeaderCell>
                        <CTableHeaderCell
                          class="text-center"
                          style="width: 8%"
                          >{{ $t('courses.name') }}</CTableHeaderCell
                        >
                        <CTableHeaderCell
                          class="text-center"
                          style="width: 20%"
                          >{{ $t('courses.email') }}</CTableHeaderCell
                        >
                        <CTableHeaderCell
                          class="text-center"
                          style="width: 3%"
                          >{{ $t('common.action') }}</CTableHeaderCell
                        >
                      </CTableRow>
                    </CTableHead>
                    <CTableBody>
                      <CTableRow
                        v-if="entry.course_accounts.length === 0"
                        class="noData"
                      >
                        <CTableDataCell colspan="100%">
                          <span class="label-no-data">{{
                            $t('common.no_data')
                          }}</span>
                        </CTableDataCell>
                      </CTableRow>
                      <CTableRow
                        v-else
                        v-for="(user, userIdx) in entry.course_accounts"
                        :key="'user_' + userIdx"
                      >
                        <CTableDataCell class="text-center">
                          <datatable-tooltip
                            :text="(userIdx + 1).toString()"
                          />
                        </CTableDataCell>
                        <CTableDataCell>
                          <datatable-tooltip :text="user.name" />
                        </CTableDataCell>
                        <CTableDataCell>
                          <datatable-tooltip :text="user.email" />
                        </CTableDataCell>
                        <!-- <CTableDataCell class="text-center icon-delete">
                          <CTooltip
                            :content="$t('buttons.delete')"
                            placement="top"
                          >
                            <template #toggler="{ on }">
                              <a href="javascript:void(0);" v-on="on">
                                <font-awesome-icon
                                  icon="fa-solid fa-trash"
                                  color="red"
                                  class="icon-font-size"
                                  @click="removeStaff(userIdx)"
                                />
                              </a>
                            </template>
                          </CTooltip>
                        </CTableDataCell> -->
                      </CTableRow>
                    </CTableBody>
                  </CTable>
                </div>
              </div>
              <CRow class="mb-3">
                <CCol
                  :lg="configs.grids.xs"
                  :xs="configs.grids.xs"
                  class="mt-5 text-center"
                >
                  <CButton
                    type="button"
                    color="secondary"
                    class="btn btn-cancel m-2"
                    @click="backToList()"
                  >
                    {{ $t('buttons.cancel') }}
                  </CButton>
                  <CButton type="submit" color="primary" class="btn btn-action">
                    {{
                      !isEditScreen ? $t('buttons.save') : $t('buttons.register')
                    }}
                  </CButton>
                </CCol>
              </CRow>
            </div>
          </vee-form>
        </form>
      </CCardBody>
    </MainLayout>
    <SelectedUserModal
      :visible="visibleUserSelectModal"
      :close-callback="closeSelectedUserModal"
      :initial-data="userList"
      :set-data-callback="setUserListCallback"
      :params-modal="paramsModal"
    />
  </div>
</template>

<script>
import { ACCOUNT_STATUS, COLUMN_CONFIG, ACCOUNT_ROLE } from '@/config/consts'
import CommonCreate from '@/views/common/Create.vue'
import MainLayout from '@/layouts/MainLayout.vue'
import SelectedUserModal from '@/components/Common/Modal/SelectedUserModal.vue'
export default {
  name: 'CourseCreate',
  extends: CommonCreate,
  components: {
    MainLayout,
    SelectedUserModal,
  },
  data() {
    return {
      typeScreen: 'create',
      configs: COLUMN_CONFIG,
      ACCOUNT_STATUS: ACCOUNT_STATUS,
      ACCOUNT_ROLE,
      entry: {
        course_accounts: [],
        name: '',
        descriptions: '',
      },
      repositoryName: 'course',
      routerListScreenName: 'ListCourse',
      visibleUserSelectModal: false,
      userList: [],
      initData: {},
      paramsModal: {},
    }
  },

  beforeRouteLeave(to) {
    return this.checkDirty(to)
  },
  methods: {
    async initEdit() {
      this.typeScreen === 'edit'
      await this.$repositories[this.repositoryName]
        .get(this.$route.params.id)
        .then((res) => {
          const data = res.data.results
          this.initData = { ...data }
          this.entry = { ...data }
        })
        .catch(() => {
          this.dirtyCheck = false
          this.$router.push({
            name: 'Page404',
          })
        })
    },
    handleUpdate(data) {
      console.log(data)
      this.$repositories[this.repositoryName]
        .update(data.id, data)
        .then((response) => {
          this.$toast.success(response.data.message)
          this.dirtyCheck = false
          this.backToList()
        })
        .catch((response) => {
          this.$toast.error(response.message)
        }).finally(() => {
        })
    },
    openSelectedUserModal() {
      this.userList = []
      this.visibleUserSelectModal = true
    },
    closeSelectedUserModal() {
      this.visibleUserSelectModal = false
    },
    setUserListCallback(userList) {
      this.entry.course_accounts = [...this.entry.course_accounts, ...userList]
    },
  },
}
</script>

<style lang="scss" scoped></style>
