import path from 'node:path'
import { fileURLToPath } from 'node:url'
import fs from 'node:fs'

import dotenv from 'dotenv'
import express from 'express'
import nodemailer from 'nodemailer'

import { buildEmailHtml } from './emailTemplate.js'

dotenv.config({ path: path.resolve(process.cwd(), '.env') })

const __dirname = path.dirname(fileURLToPath(import.meta.url))
const distPath = path.resolve(__dirname, '..', 'dist')

const port = Number(process.env.PORT || 3001)
const operatorEmail = (process.env.OPERATOR_EMAIL || '').trim()
const yandexAppPassword = (process.env.YANDEX_APP_PASSWORD || '').trim()

const app = express()
app.use(express.json())

app.post(['/api/send', '/api/send.php'], async (req, res) => {
  if (!operatorEmail || !yandexAppPassword) {
    return res.status(500).json({
      error: 'Не заданы OPERATOR_EMAIL и YANDEX_APP_PASSWORD в .env',
    })
  }

  const {
    name = '',
    phone = '',
    email = '',
    message = '',
    needLawyer = false,
    needFinancist = false,
    consentMarketing = false,
  } = req.body ?? {}

  const data = {
    name: name || '—',
    phone: phone || '',
    email: email || '',
    message: message || '—',
    needLawyer,
    needFinancist,
    consentMarketing,
  }

  const transporter = nodemailer.createTransport({
    host: 'smtp.yandex.ru',
    port: 465,
    secure: true,
    auth: { user: operatorEmail, pass: yandexAppPassword },
  })

  try {
    await transporter.sendMail({
      from: `"Экстренная бухгалтерия" <${operatorEmail}>`,
      to: operatorEmail,
      replyTo: operatorEmail,
      subject: `Новая заявка: ${data.name} ${data.phone ?? ''} ${data.email ?? ''}`,
      html: buildEmailHtml(data),
    })
    return res.json({ ok: true })
  } catch (error) {
    console.error(error)
    return res.status(500).json({
      error: 'Не удалось отправить письмо. Проверьте настройки Яндекс.Почты.',
      detail: error?.message || String(error),
    })
  }
})

// Продакшен: раздача статики и SPA (если есть папка dist)
if (fs.existsSync(distPath)) {
  app.use(express.static(distPath))
  app.get('*', (req, res) => {
    if (req.path.startsWith('/api')) return res.status(404).end()
    res.sendFile(path.join(distPath, 'index.html'))
  })
}

app.listen(port, () => {
  console.log(`Mail server started`)
})
