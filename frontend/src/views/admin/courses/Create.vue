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
                    v-model="entry.description"
                    rules="required"
                    label="courses.description"
                  />
                  <ErrorMessage name="description" />
                </CCol>
              </CRow>
              <CRow class="mb-3">
                <CCol :lg="configs.grids.label" :xs="configs.grids.xs">
                  <label class="form-label">
                    {{ $t('courses.user_name') }}<span class="required">*</span>
                  </label>
                </CCol>
                <CCol :lg="configs.grids.input" :xs="configs.grids.xs">
                  <CInputGroup>
                    <vee-field
                      id="userName"
                      name="userName"
                      class="form-control"
                      type="text"
                      hidden
                    />
                    <vee-field
                      id="user_name"
                      name="user_name"
                      class="form-control border-group-field"
                      type="text"
                      maxlength="64"
                      rules="required"
                      disabled
                      label="courses.user_name"
                    />
                    <CButton
                      type="button"
                      color="primary"
                      variant="outline"
                      id="button-addon2"
                      class="btn-modal"
                      @click="openSelectedUserModal()"
                    >
                      <CIcon icon="cilSearch" />
                    </CButton>
                  </CInputGroup>
                  <ErrorMessage name="user_name" />
                </CCol>
              </CRow>
              <div
                class="subDatatableContainer"
                style="
                   {
                    height: 100%;
                  }
                "
              >
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
                          >{{
                            $t('courses.name')
                          }}</CTableHeaderCell
                        >
                        <CTableHeaderCell
                          class="text-center"
                          style="width: 20%"
                          >{{
                            $t('courses.email')
                          }}</CTableHeaderCell
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
                        v-if="entry.products.length === 0"
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
                        v-for="(product, productIdx) in entry.products"
                        :key="'product_' + productIdx"
                      >
                        <CTableDataCell class="text-center">
                          <datatable-tooltip
                            :text="(productIdx + 1).toString()"
                          />
                        </CTableDataCell>
                        <CTableDataCell>
                          <datatable-tooltip :text="product.name" />
                        </CTableDataCell>
                        <CTableDataCell>
                          <datatable-tooltip :text="product.email" />
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
                                  @click="removeStaff(productIdx)"
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
                      !isEditScreen ? $t('buttons.save') : $t('buttons.save')
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
      :initial-data="productList"
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
        products: [],
      },
      repositoryName: 'account',
      routerListScreenName: 'ListCourse',
      visibleUserSelectModal: false,
      productList: [],
      initData: {},
      paramsModal: {},
    }
  },

  beforeRouteLeave(to) {
    return this.checkDirty(to)
  },
  methods: {
    // async initEdit() {
    //   this.typeScreen = 'edit'
    //   await this.$repositories[this.repositoryName]
    //     .get(this.$route.params.id)
    //     .then((res) => {
    //       const data = res.data.results
    //       data.status = data.status.toString()
    //       this.initData = { ...data }
    //       this.entry = { ...data }
    //       if (
    //         this.typeScreen === 'edit' &&
    //         this.isNotSetPasswordAndValidMail
    //       ) {
    //         this.displayButtonSendMail = true
    //       }
    //     })
    //     .catch(() => {
    //       this.dirtyCheck = false
    //       this.$router.push({
    //         name: 'Page404',
    //       })
    //     })
    // },
    openSelectedUserModal() {
      this.productList = []
      this.visibleUserSelectModal = true
    },
    closeSelectedUserModal() {
      this.visibleUserSelectModal = false
    },
    setUserListCallback(productList) {
      this.entry.products = [...this.entry.products, ...productList]
    },
  },
}
</script>

<style lang="scss" scoped></style>
