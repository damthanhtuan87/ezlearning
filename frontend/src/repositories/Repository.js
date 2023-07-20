import AdminRepository from '@/repositories/client/AdminRepository'
import AuthRepository from '@/repositories/client/AuthRepository'
import MasterRepository from '@/repositories/client/MasterRepository'
import AccountRepository from "@/repositories/client/AccountRepository";
import TransmissionRepository from '@/repositories/client/TransmissionRepository'
import CourseRepository from '@/repositories/client/CourseRepository'
import QuestionRepository from './client/QuestionRepository';

const Plugin = (app) => {
  const repo = {
    admin: AdminRepository(app.$axios),
    auth: AuthRepository(app.$axios),
    master: MasterRepository(app.$axios),
    account: AccountRepository(app.$axios),
    transmission: TransmissionRepository(app.$axios),
    course: CourseRepository(app.$axios),
    questions: QuestionRepository(app.$axios),
    // TODO add other repository
    // Usage: this.$repositories.user.update()
  }

  app.$repositories = repo
  app.config.globalProperties.$repositories = repo
}

export default {
  install: Plugin,
}
