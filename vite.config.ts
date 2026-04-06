import { fileURLToPath, URL } from 'node:url'

import { defineConfig, loadEnv } from 'vite'
import vue from '@vitejs/plugin-vue'
import vueDevTools from 'vite-plugin-vue-devtools'

// vite-node (сервер) подгружает этот конфиг — vueDevTools/inspect ломаются без dev-сервера
const isViteNode = process.argv[1]?.includes('vite-node')

// https://vite.dev/config/
export default defineConfig(({ mode }) => {
  const env = loadEnv(mode, process.cwd(), '')
  const apiTarget = env.API_PROXY_TARGET?.trim() || 'http://127.0.0.1:3001'

  return {
    envPrefix: ['VITE_', 'OPERATOR_'],
    plugins: [
      vue(),
      ...(isViteNode ? [] : [vueDevTools()]),
    ],
    resolve: {
      alias: {
        '@': fileURLToPath(new URL('./src', import.meta.url))
      },
    },
    server: {
      proxy: {
        '/api': {
          target: apiTarget,
          changeOrigin: true,
        },
      },
    },
  }
})
