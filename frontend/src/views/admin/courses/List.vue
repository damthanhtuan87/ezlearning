<template>
  <MainLayout>
    <CCardHeader>
      <strong>{{ $t('courses.title_list') }}</strong>
    </CCardHeader>
    <CCardBody>
      <div class="wrapper_search mb-4">
        <CRow class="search_fields">
          <CCol :lg="configs.grids.lg" :xs="configs.grids.xs" class="mb-2">
            <CFormInput
              placeholder="Enter course name"
              type="text"
              :label="$t('courses.search_name_courses')"
              v-model="condition_search.course_name"
            />
          </CCol>
        </CRow>
        <div class="divider"></div>
        <CRow class="mt-3">
          <CCol class="text-center">
            <CButton
              type="button"
              color="secondary"
              class="me-3 btn-action btn-reset"
              @click="handleResetSearch()"
              >{{ $t('buttons.reset') }}
            </CButton>
            <CButton
              class="btn-action mr-0"
              type="button"
              color="primary"
              @click="handleSearch()"
              >{{ $t('buttons.search') }}
            </CButton>
          </CCol>
        </CRow>
      </div>
      <CRow class="mb-4">
        <CCol class="text-end">
          <router-link
            :to="{
              name: 'CreateCourse',
            }"
          >
            <CButton color="primary" class="btn-action"
              >{{ $t('buttons.create') }}
            </CButton>
          </router-link>
        </CCol>
      </CRow>
      <CCol :xs="12">
        <data-table ref="dataTable" :get-data="getList">
          <CTableHeaderCell scope="col" style="width: 3%">
            {{ $t('common.course_view.course_id') }}
          </CTableHeaderCell>
          <CTableHeaderCell scope="col" style="width: 5%">
            {{ $t('common.course_view.course_name') }}
          </CTableHeaderCell>
          <CTableHeaderCell scope="col" style="width: 15%">
            {{ $t('common.course_view.course_description') }}
          </CTableHeaderCell>
          <CTableHeaderCell scope="col" style="width: 5%">
            {{ $t('common.course_view.quantity') }}
          </CTableHeaderCell>
          <CTableHeaderCell scope="col" style="width: 8%">
            {{ $t('common.course_view.action') }}
          </CTableHeaderCell>
          <template v-slot:body="props">
            <CTableRow>
              <CTableDataCell class="text-center">
                {{ props.item.id }}
              </CTableDataCell>
              <CTableDataCell class="text-center">
                {{ props.item.name }}
              </CTableDataCell>
              <CTableDataCell>
                {{ props.item.descriptions }}
              </CTableDataCell>
              <CTableDataCell class="text-center">
                {{ props.item.total_quantity }}
              </CTableDataCell>
              <CTableDataCell class="text-center my-3 action-col">
                  <router-link
                    :to="{
                      name: 'UpdateCourse',
                      params: { id: props.item.id },
                    }"
                  >
                    <CButton
                      type="button"
                      color="primary"
                      class="btn-action mr-2"
                    >
                      {{ $t('buttons.edit') }}
                    </CButton>
                  </router-link>
                  <CButton
                    class="btn-action mr-0"
                    type="button"
                    color="primary"
                    @click="handleDelete(props.item)"
                    >{{ $t('buttons.delete') }}
                  </CButton>
              </CTableDataCell>
            </CTableRow>
          </template>
        </data-table>
      </CCol>
    </CCardBody>
  </MainLayout>
</template>
<script>
import { ACCOUNT_STATUS, DEFAULT_PAGE } from '@/config/consts'
import CommonList from '@/views/common/CommonList.vue'
import MainLayout from '@/layouts/MainLayout.vue'

export default {
  name: 'CourseList',
  extends: CommonList,
  components: {
    MainLayout,
  },
  data() {
    return {
      configs: {
        grids: {
          lg: 3,
          xs: 12,
        },
      },
      condition_search: this.initialSearch(),
      visibleDeleteModal: false,
      selectedItem: 0,
      repositoryName: 'course',
      offset: 0,
      lastPerPage: DEFAULT_PAGE,
      ACCOUNT_STATUS: ACCOUNT_STATUS,
      sort: {},
      currentConditionSearch: null,
      submitSearch: false,
    }
  },

  props: {
    roleId: {
      type: String,
      required: false,
    },
  },

  mounted() {},

  methods: {
    initialSearch() {
      return {
        course_name: '',
        componentName: 'CourseList',
      }
    },

    async handleDelete(item) {
      if (item.status == ACCOUNT_STATUS.VALID) {
        this.visibleDeleteModal = false
        return this.$toast.error(
          this.$t('messages.common.cannot_delete_data_active', [
            this.$t('common.active'),
          ]),
        )
      }
      await this.$repositories.course
        .delete(item.id, { updated_at: item.updated_at })
        .then((response) => {
          this.$toast.success(response.data.message)
          this.refresh()
        })
        .catch((response) => {
          this.$toast.error(response.message)
        })
        .finally(() => {
          this.visibleDeleteModal = false
        })
    },
  },
}
</script>
