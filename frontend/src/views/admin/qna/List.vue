<template>
  <MainLayout>
    <CCardHeader>
      <strong>{{ $t('qna.title_list') }}</strong>
    </CCardHeader>
    <CCardBody>
      <div class="wrapper_search mb-4">
        <CRow class="search_fields">
          <CCol :lg="configs.grids.lg" :xs="configs.grids.xs" class="mb-2">
            <CFormInput
              placeholder="Enter account name or email"
              type="text"
              :label="$t('admins.search')"
              v-model="condition_search.search"
            />
          </CCol>
          <CCol :lg="configs.grids.lg" :xs="configs.grids.xs" class="mb-2">
            <label for="" class="form-label">{{ $t('courses.search_name_courses') }}</label>
            <CInputGroup>
              <vee-field
                id="userName"
                name="userName"
                class="form-control"
                type="text"
                v-model="selectedCourse.name"
                hidden
              />
              <vee-field
                id="user_name"
                name="user_name"
                class="form-control border-group-field"
                type="text"
                maxlength="64"
                rules="required"
                v-model="selectedCourse.name"
                disabled
              />
              <CButton
                type="button"
                color="primary"
                variant="outline"
                id="button-addon2"
                class="btn-modal"
                @click="openSelectedCourseModal()"
              >
                <CIcon icon="cilSearch" />
              </CButton>
            </CInputGroup>
          </CCol>
          <CCol :lg="configs.grids.lg" :xs="configs.grids.xs" class="mb-2">
            <label for="" class="form-label">{{ $t('topics.search_name_topics') }}</label>
            <CInputGroup>
              <vee-field
                id="userName"
                name="userName"
                class="form-control"
                type="text"
                v-model="selectedTopic.name"
                hidden
              />
              <vee-field
                id="user_name"
                name="user_name"
                class="form-control border-group-field"
                type="text"
                maxlength="64"
                rules="required"
                v-model="selectedTopic.name"
                disabled
              />
              <CButton
                type="button"
                color="primary"
                variant="outline"
                id="button-addon2"
                class="btn-modal"
                :disabled="!selectedCourse.id"
                @click="openSelectedTopicModal()"
              >
                <CIcon icon="cilSearch" />
              </CButton>
            </CInputGroup>
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
              name: 'CreateAccount',
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
          <CTableHeaderCell scope="col" style="width: 10%">
            {{ $t('common.label_column_no') }}
          </CTableHeaderCell>
          <CTableHeaderCell scope="col" style="width: 40%">
            {{ $t('common.qna_view.question') }}
          </CTableHeaderCell>
          <CTableHeaderCell scope="col" style="width: 40%">
            {{ $t('common.qna_view.describe') }}
          </CTableHeaderCell>
          <CTableHeaderCell scope="col" style="width: 10%">
            {{ $t('common.action') }}
          </CTableHeaderCell>
          <template v-slot:body="props">
            <CTableRow>
              <CTableDataCell class="text-center">
                {{ props.item.id }}
              </CTableDataCell>
              <CTableDataCell class="text-center">
                {{ props.item.content }}
              </CTableDataCell>
              <CTableDataCell class="text-center my-3 action-col">
                {{ props.item.description }}
              </CTableDataCell>
              <CTableDataCell class="text-center my-3 action-col">
                <div class="d-inline-flex">
                  <router-link
                    :to="{
                      name: 'UpdateAccount',
                      params: { id: props.item.id },
                    }"
                    v-on="on"
                    class="mr-10"
                  >
                    <font-awesome-icon
                      icon="fa-solid fa-pen"
                      class="me-3 icon-font-size"
                    />
                  </router-link>
                </div>
              </CTableDataCell>
            </CTableRow>
          </template>
        </data-table>
      </CCol>
      <selected-course-modal
        :visible="visibleSelectedCourseModal"
        :close-callback="closeSelectedCourseModal"
        :initial-data="[selectedCourse]"
        :params-modal="paramsModal"
        :set-data-callback="setCourseListCallback"
      />
      <selected-topic-modal
        :visible="visibleSelectedTopicModal"
        :close-callback="closeSelectedTopicModal"
        :initial-data="[selectedTopic]"
        :params-modal="paramsModal"
        :set-data-callback="setTopicListCallback"
        :course-id="selectedCourse.id"
      />
    </CCardBody>
  </MainLayout>
</template>

<script>
import { ACCOUNT_STATUS, DEFAULT_PAGE, STATUS } from '@/config/consts'
import { getItemLabelInArray } from '@/utils/functions'
import CommonList from '@/views/common/CommonList.vue'
import MainLayout from '@/layouts/MainLayout.vue'
import SelectedCourseModal from '@/components/Common/Modal/SelectedCourseModal.vue'
import SelectedTopicModal from '@/components/Common/Modal/SelectedTopicModal.vue'

export default {
  name: 'QuestionList',
  extends: CommonList,
  components: {
    MainLayout,
    SelectedCourseModal,
    SelectedTopicModal,
  },

  data() {
    return {
      configs: {
        grids: {
          lg: 4,
          xs: 12,
        },
      },
      condition_search: this.initialSearch(),
      visibleDeleteModal: false,
      selectedItem: 0,
      ACCOUNT_STATUS: ACCOUNT_STATUS,
      STATUS: STATUS,
      getItemLabelInArray,
      repositoryName: 'questions',
      offset: 0,
      lastPerPage: DEFAULT_PAGE,
      sort: {},
      currentConditionSearch: null,
      submitSearch: false,
      visibleSelectedCourseModal: false,
      productList: [],
      selectedCourse: {},
      selectedTopic: {},
      visibleSelectedTopicModal: false,
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
        search: '',
        courseId: '',
        topicId: '',
        componentName: 'QuestionList',
      }
    },

    openSelectedCourseModal() {
      this.productList = []
      this.visibleSelectedCourseModal = true
    },

    closeSelectedCourseModal() {
      this.visibleSelectedCourseModal = false
    },

    setCourseListCallback(item) {
      if (!this.selectedCourse) {
        this.selectedCourse = JSON.parse(JSON.stringify(item[0]))
        this.condition_search.courseId = this.selectedCourse.id
      }
      if (this.selectedCourse.id !== item[0].id) {
        this.selectedCourse = JSON.parse(JSON.stringify(item[0]))
        this.condition_search.courseId = this.selectedCourse.id
        this.selectedTopic = {}
        this.condition_search.topicId = ''
      }
    },

    openSelectedTopicModal() {
      this.productList = []
      this.visibleSelectedTopicModal = true
    },

    closeSelectedTopicModal() {
      this.visibleSelectedTopicModal = false
    },

    setTopicListCallback(item) {
      this.selectedTopic = JSON.parse(JSON.stringify(item[0]))
      this.condition_search.topicId = this.selectedTopic.id
    },
  },
}
</script>
