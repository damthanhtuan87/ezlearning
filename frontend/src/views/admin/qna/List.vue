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
                  <CFormSelect
                    aria-label="Default select example"
                    :label="$t('admins.search')"
                    v-model="condition_search.course_id"
                    :options="[
                      'Open this select menu',
                      { label: 'One', value: '1' },
                      { label: 'Two', value: '2' },
                      { label: 'Three', value: '3', disabled: true }
                    ]">
                  </CFormSelect>
                </CCol>
                <CCol :lg="configs.grids.lg" :xs="configs.grids.xs" class="mb-2">
                  <CFormSelect
                    aria-label="Default select example"
                    :label="$t('admins.search')"
                    v-model="condition_search.topic_id"
                    :options="[
                      'Open this select menu',
                      { label: 'One', value: '1' },
                      { label: 'Two', value: '2' },
                      { label: 'Three', value: '3', disabled: true }
                    ]">
                  </CFormSelect>
                </CCol>
                <CCol :lg="configs.grids.lg" :xs="configs.grids.xs" class="mb-2">
                  <CFormSelect
                    aria-label="Default select example"
                    :label="$t('admins.search')"
                    v-model="condition_search.search"
                    :options="[
                      'Open this select menu',
                      { label: 'One', value: '1' },
                      { label: 'Two', value: '2' },
                      { label: 'Three', value: '3', disabled: true }
                    ]">
                  </CFormSelect>
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
                <CTableHeaderCell scope="col" style="width: 40%" >
                  {{ $t('common.qna_view.question') }}
                </CTableHeaderCell>
                <CTableHeaderCell scope="col" style="width: 40%" >
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
          </CCardBody>
    </MainLayout>
    <confirm-delete-modal
      :visible="visibleDeleteModal"
      @onClose="visibleDeleteModal = false"
      @handleDelete="handleDelete(selectedItem)"
    >
      {{ $t('popup.text_delete', [$t('admins.name'), selectedItem.name]) }}
    </confirm-delete-modal>
  </template>
  
  <script>
  import {ACCOUNT_STATUS, DEFAULT_PAGE, STATUS} from '@/config/consts'
  import { getItemLabelInArray } from '@/utils/functions'
  import CommonList from "@/views/common/CommonList.vue";
  import MainLayout from '@/layouts/MainLayout.vue'
  
  export default {
    name: 'QuestionList',
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
        ACCOUNT_STATUS: ACCOUNT_STATUS,
        STATUS: STATUS,
        getItemLabelInArray,
        repositoryName: 'questions',
        offset: 0,
        lastPerPage: DEFAULT_PAGE,
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
    mounted() {
    },
    methods: {
      initialSearch() {
        return {
          search: '',
          course_id: '',
          topic_id: '',
          componentName: 'QuestionList',
        }
      },
    },
  }
  </script>
  