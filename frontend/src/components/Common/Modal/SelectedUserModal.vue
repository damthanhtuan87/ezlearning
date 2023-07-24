<template>
  <CModal :visible="visible" @close="() => onClose()" size="xl">
    <CModalHeader>
      <CModalTitle>
        <label class="modal-title">{{ $t('modals.user_selection') }}</label>
      </CModalTitle>
    </CModalHeader>
    <CModalBody>
      <div class="wrapper_search mb-4">
        <CRow class="search_fields modal-title">
          <CCol :md="4" :xs="12" class="mb-2">
            <CFormLabel for="products.id">{{ $t('courses.id') }}</CFormLabel>
            <CFormInput
              type="text"
              id="firstFocus"
              name="courses.id"
              aria-describedby="Courses Id"
              v-model="option_search.id"
            />
          </CCol>
          <CCol :md="4" :xs="12" class="mb-2">
            <CFormLabel for="courses.name">
              {{ $t('courses.name') }}
            </CFormLabel>
            <CFormInput
              type="text"
              name="courses.name"
              aria-describedby="Course name"
              v-model="option_search.name"
            />
          </CCol>
        </CRow>
        <CRow class="mt-4">
          <CCol class="text-center">
            <CButton
              type="button"
              color="secondary"
              class="me-3 btn-action btn-reset"
              @click="handleResetSearch()"
              >{{ $t('buttons.reset') }}</CButton
            >
            <CButton
              class="btn-action mr-0"
              type="button"
              color="primary"
              @click="handleSearch()"
              >{{ $t('buttons.search') }}</CButton
            >
          </CCol>
        </CRow>
      </div>

      <data-table ref="userRef" :get-data="getUsers">
        <CTableHeaderCell scope="col" class="col-md-1" style="width: 4%">
          <CFormCheck
            :checked="selectedAll"
            :disabled="disabledAll"
            @click="selectAll($event)"
            v-if="!typeInputRadio"
          />
        </CTableHeaderCell>
        <CTableHeaderCell scope="col" data-sort-field="id" style="width: 18%"
          >{{ $t('courses.id') }}<sort-icon field="id" :sort="sort" />
        </CTableHeaderCell>
        <CTableHeaderCell scope="col" data-sort-field="name" style="width: 26%"
          >{{ $t('courses.name') }}<sort-icon field="name" :sort="sort" />
        </CTableHeaderCell>
        <CTableHeaderCell scope="col" data-sort-field="email" style="width: 26%"
          >{{ $t('courses.email') }}<sort-icon field="email" :sort="sort" />
        </CTableHeaderCell>
        <template v-slot:body="props">
          <CTableRow>
            <CTableDataCell class="text-center">
              <CFormCheck
                :checked="isSelected(props.item.id)"
                :disabled="isAdded(props.item.id)"
                @click="addItem(props.item, $event)"
                v-if="!typeInputRadio"
              />
              <CFormCheck
                type="radio"
                name="selected_product"
                :id="`selected_product${props.item.id}`"
                @click="onCheckedRadio(props.item)"
                :checked="isAdded(props.item.id)"
                v-else
              />
            </CTableDataCell>
            <CTableDataCell class="text-center" style="width: 20%"
              ><datatable-tooltip :text="props.item.id.toString()"
            /></CTableDataCell>
            <CTableDataCell class="text-center" style="width: 20%"
              ><datatable-tooltip :text="props.item.name"
            /></CTableDataCell>
            <CTableDataCell class="text-center" style="width: 20%"
              ><datatable-tooltip :text="props.item.email"
            /></CTableDataCell>
          </CTableRow>
        </template>
      </data-table>
    </CModalBody>
    <CModalFooter>
      <CButton
        type="button"
        color="secondary"
        class="me-3 btn-action btn-reset"
        @click="onClose"
        >{{ $t('buttons.cancel') }}</CButton
      >
      <CButton
        class="btn-action mr-0 btn btn-dis"
        type="button"
        color="primary"
        @click="onSave"
        :disabled="!this.selectedList.length > 0"
        >{{ $t('buttons.register') }}</CButton
      >
    </CModalFooter>
  </CModal>
</template>

<script>
import DataTable from '@/components/Common/DataTable/DataTable'
import sortIcon from '@/components/Common/SortIcon'
import datatableTooltip from '@/components/Common/DataTable/Tooltip.vue'
import { isEmptyArray, isNullOrUndefined } from '@/utils/functions'
import { ACCOUNT_ROLE } from '@/config/consts'
function initialSearch() {
  return {
    code: '',
    id: '',
    name: '',
    ctplaning_code: '',
    factory_name: '',
    customer_id: '',
    business_partner_id: '',
    type: '',
    contract_type: '',
    selected_customer: '',
    selected_business_partner: '',
    is_from_modal: '1',
    ACCOUNT_ROLE,
  }
}

export default {
  name: 'SelectedUserModal',
  components: {
    'data-table': DataTable,
    sortIcon,
    datatableTooltip,
  },
  props: {
    visible: {
      type: Boolean,
      default: true,
    },
    closeCallback: {
      type: Function,
    },
    initialData: {
      type: Array,
      default: null,
    },
    setDataCallback: {
      type: Function,
      default: () => {},
    },
    totalSelect: {
      type: Number,
      default: null,
    },
    typeInputRadio: {
      type: Boolean,
      default: false,
    },
    paramsModal: {
      type: Object,
      default: null,
    },
    entryDataFromContractSet: {
      type: Boolean,
      default: false,
    },
    hasDefaultQuantity: {
      type: Boolean,
      default: true,
    },
  },
  data() {
    return {
      option_search: initialSearch(),
      selectedList: [...this.initialData],
      additionalData: [],
      listProduct: [],
      selectedAll: false,
      disabledAll: false,
      sort: {},
      repositoryName: 'account',
    }
  },
  watch: {
    initialData: function (value) {
      this.selectedList = [...value]
    },
    visible: function () {
      this.$nextTick(function () {
        document.getElementById('firstFocus').focus()
      })
    },
  },
  methods: {
    async getUsers(params) {
      this.option_search.user_role = ACCOUNT_ROLE.USER
      this.sort = params.sort
      let res = await this.$repositories[this.repositoryName].getListUserModal(
        Object.assign({}, params, {
          filter: this.option_search,
          usingFunction: this.paramsModal?.usingFunction,
        }),
      )
      this.listProduct = res.data.results.data
      if (this.isSelectedAll() && this.listProduct.length > 0) {
        this.pushAllProduct()
        this.selectedAll = true
        this.disabledAll = true
      }
      return Promise.resolve({
        results: res.data.results,
      })
    },
    refresh() {
      this.$refs.userRef.refresh()
    },
    handleSearch() {
      this.$refs.userRef.resetSort()
      this.refresh()
    },
    handleResetSearch() {
      this.$data.option_search = initialSearch()
      this.$refs.userRef.resetSort()
      this.refresh()
    },
    isAdded(productId) {
      let productIdx

      productIdx = this.initialData.findIndex(
        (product) => productId == product.id,
      )

      return productIdx > -1
    },
    isSelected(productId) {
      let productIdx
      productIdx = this.selectedList.findIndex(
        (product) => productId == product.id,
      )

      return productIdx > -1
    },
    addItem(product, event) {
      if (event.target.checked) {
        if (!isNullOrUndefined(this.paramsModal.usingFunction)) {
          this.additionalData.push(product)
        }
        this.selectedList.push(product)
        if (this.isSelectedAll()) {
          this.selectedAll = true
        }
      } else {
        if (!isNullOrUndefined(this.paramsModal.usingFunction)) {
          for (let i = 0; i < this.additionalData.length; i++) {
            if (this.additionalData[i].id === product.id) {
              this.additionalData.splice(i, 1)
            }
          }
        }
        for (let i = 0; i < this.selectedList.length; i++) {
          if (this.selectedList[i].id === product.id) {
            this.selectedList.splice(i, 1)
          }
        }
        this.selectedAll = false
      }
    },
    isSelectedAll() {
      for (let i = 0; i < this.listProduct.length; i++) {
        const productIdx = this.selectedList.findIndex(
          (selected) => this.listProduct[i].id === selected.id,
        )
        if (productIdx === -1) {
          this.selectedAll = false
          this.disabledAll = false
          return false
        }
      }
      return true
    },
    selectAll(event) {
      if (
        event.target.checked &&
        !this.isSelectedAll() &&
        this.listProduct.length > 0
      ) {
        this.pushAllProduct()
      } else {
        if (isEmptyArray(this.initialData)) {
          this.selectedList = []
        } else {
          this.selectedList = [...this.initialData]
        }
        this.additionalData = []
      }
      this.selectedAll = !this.selectedAll
    },
    onClose() {
      this.closeCallback()
    },
    onSave() {
      if (!isNullOrUndefined(this.paramsModal?.usingFunction)) {
        this.setDataCallback(this.additionalData)
        this.additionalData = []
      } else {
        this.setDataCallback(this.selectedList)
      }
      this.onClose()
    },
    onCheckedRadio(product) {
      this.selectedList = [product]
    },
    pushAllProduct() {
      let productIdx
      for (let i = 0; i < this.listProduct.length; i++) {
        productIdx = this.selectedList.findIndex(
          (selected) => this.listProduct[i].id === selected.id,
        )
        if (productIdx === -1) {
          this.additionalData.push(this.listProduct[i])
          this.selectedList.push(this.listProduct[i])
        }
      }
    },
  },
}
</script>
