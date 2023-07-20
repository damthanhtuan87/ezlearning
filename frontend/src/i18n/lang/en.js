const en = {
  admins: {
    title_list: 'Account List',
    title_create: 'Account Create',
    title_update: 'Account Edit',
    role: 'Role',
    name: 'Name',
    email: 'Email',
    status: 'Status',
    search: 'Search',
  },

  login: {
    email: 'Email',
    password: 'Password',
    new_password: 'New password',
    new_password_confirmation: 'Confirm new password',
  },

  auth: {
    login: 'LOGIN',
    forgot_password: 'Forgot your password?',
    remember_me: 'Remember me?',
    request_password: 'Reset Password',
    guide_reset_password: 'Enter your Email address. We will send you a link to reset password.',
    reset_password: 'Reset password',
    send_mail: 'Send mail',
    back_to_login: 'Back to login',
    go_to_login: 'Go to login',
    update_password: 'Change Password',
    request_mail_sent: `Password reset request was sent succcessfully, please check your email to reset your password.`,
  },

  transmission: {
    title_list: 'Transmission Log',
    period: 'Execution Date From～To',
    process: 'Process',
    hotel: 'Hotel',
    status: 'Status',
    endpoint: 'Endpoint',
    method: 'Method',
    start_time: 'Start time',
    end_time: 'End time',
    result: 'Result',
    process_options: {
      from_tll: 'From TL-Lincoln',
      from_rs: 'From relay system',
    },
    endpoint_options: {
      update_rate: 'Update rate',
      plan_master: 'Plan master',
    },
    status_options: {
      not_done: 'Not done',
      in_progress: 'In progress',
      completed: 'Completed',
      error: 'Error',
    },
    method_options: {
      get: 'Get',
      post: 'Post',
      put: 'Put',
      delete: 'Delete',
      patch: 'Patch'
    },
  },

  // QUESTIONS AND ANSWERS
  qna: {
    title_list: 'List Q&A',
    title_create: 'Add New Q&A',
    title_update: 'Edit Q&A',
  },

  search: { 
  },

  courses : {
    search_name_courses: "Course name",
    search_topic_of_courses: "Topic of courses",
    title_list: "Course List",
    title_create: "Add New Course",
    title_update: "Update Course",
    name: "Name",
    description: "Description",
    user_name: "User Name",
    email: 'Email',
    id: 'ID',
  },

}

en.messages = {
  auth: {
    //MS04-001
    login_success: 'Logged in successfully.',
    login_failed: 'Login failed',
  },
}

en.menu = {
  dashboard: 'Dashboard',
  hotel_create: 'Hotel Create',
  account_setting: 'Account Setting',
  account_add_new: 'Add New Account',
  block_account: "Account",
  account_management: "Accounts",
  account_list: "Account List",
  account_add: "Add Account",
  hotel_management: "Hotels",
  hotel_list: "Hotel List",
  hotel_add: "Add Hotel",
  transmission_management: "Transmission Logs",
  course_management: "Courses",
  courses: "List Courses",
  course_add: "Add New Course",
  logout: 'Log Out',

  // QUESTIONS AND ANSWERS
  qna_management: 'Questions Answers',
  qna_list: ' List Q&A',
  qna_add: 'Add New Q&A',
}

// Validations text
en.validations = {
  required: '{0} is required.',
  min: '{1} must be more than {0} characters.',
  password: 'The password must be between 8 and 255 characters in length.',
  confirmed: '{1} must be the same as the one entered in {2}.',
  email_wrong_format: 'Invalid email format. Please try again.',
  password_format: 'Please include at least three of the following: uppercase letters, lowercase letters, numbers, and symbols (!""#$%&\'()*+,-./:;<=>?@[]^_`{|}~)', // wrong format password
}

en.fields = {
  valid: 'Valid',
  in_valid: 'Invalid',
  admin: 'Admin',
  user: 'User',
}

// Common text for screens
en.buttons = {
  save: 'Save',
  search: 'Search',
  reset: 'Reset',
  cancel: 'Cancel',
  create: 'Create',
  update: 'Update',
  send_email: 'Send Mail',
  no: 'No',
  yes: 'Yes',
  confirm: 'Confirm',
  delete: 'Delete',
  edit: 'Edit',
  register: 'Register'
}

// Common text for screens
en.common = {
  action: 'Actions',
  actions: {
    edit: 'Edit',
    delete: 'Delete',
    view: 'View',
  },
  account_view: {
    title: 'Account Setting',
    email_search: 'Email/Name',
    account_id: 'Account ID',
    account_name: 'Name',
    account_email: 'Mail address',
    account_status: 'Status',
    edit: 'Edit',
    Resend_Login_Url: 'Resend login URL'
  },
  course_view: {
    course_id: 'Course ID',
    course_name: 'Name',
    course_description: 'Description',
    action: 'Action',
    quantity: 'Quantity'
  },
  no_data: 'No data found',
  label_perpage: 'Page',
  label_column_no: 'No.',

  // QUESTIONS AND ANSWERS
  qna_view: {
    title: 'List Q&A',
    question: 'Question',
    describe: 'Describe',
  }
}

// modal
en.modals = {
  logout_modal: {
    title: 'Logout Confirm',
    content: 'Are you sure ?',
  },
  user_selection: 'User Modal',
}

export default en
