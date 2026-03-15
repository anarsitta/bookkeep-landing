/// <reference types="vite/client" />

interface ImportMetaEnv {
  readonly OPERATOR_EMAIL: string
  readonly OPERATOR_LINK_VK: string
  readonly OPERATOR_LINK_MAX: string
}

interface ImportMeta {
  readonly env: ImportMetaEnv
}
