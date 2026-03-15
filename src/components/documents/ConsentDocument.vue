<script setup lang="ts">
import { ref } from 'vue'
import DocModal from '../DocModal.vue'
import {
  operatorEmail,
  operatorFullName,
  operatorOgrn,
  operatorInn,
  operatorKpp,
  operatorAddress,
} from '@/config'

const show = ref(false)
function open() {
  show.value = true
}
function close() {
  show.value = false
}
defineExpose({ open })
</script>

<template>
  <DocModal
    :show="show"
    title="Согласие на обработку персональных данных"
    @close="close"
  >
  <div class="doc-content consent-doc">
    <p>
      В соответствии со статьей 9 Федерального закона от 27.07.2006 № 152-ФЗ
      «О персональных данных» даю свое согласие в целях, указанных ниже Оператору,
      на обработку персональных данных с использованием сайта в сети «Интернет»
      настоящего сайта:
    </p>

    <div class="consent-doc__table-wrap">
      <table class="consent-doc__table">
        <thead>
          <tr>
            <th>№</th>
            <th>Оператор</th>
            <th>Цель</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>
              {{ operatorFullName }}<br>
              ОГРН: {{ operatorOgrn }}<br>
              ИНН: {{ operatorInn }}<br>
              КПП: {{ operatorKpp }}<br>
              Юридический адрес: {{ operatorAddress }}
            </td>
            <td>
              Обработка обращений и заказов товаров/услуг, оставленных через
              веб-формы на сайте, и информирование о ходе их выполнения, а также
              оказания работ или услуг.
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <p>
      <b>Перечень персональных данных, на обработку которых дается согласие:</b>
      фамилия, имя, отчество, номер телефона, адрес электронной почты.
    </p>
    <p>
      <b>Перечень действий с персональными данными:</b> сбор, запись,
      систематизация, накопление, хранение, уточнение (обновление, изменение),
      извлечение, использование, блокирование, удаление, уничтожение.
    </p>
    <p>
      <b>Срок (условия прекращения) обработки персональных данных, в том числе их
      хранения:</b> согласие вступает в силу со дня его подписания и действует
      до момента ликвидации организации; достижения целей обработки персональных
      данных; отзыва согласия на обработку персональных данных субъектом
      персональных данных в случаях, если оператор не вправе осуществлять
      обработку персональных данных без согласия субъекта персональных данных.
    </p>
    <p>
      Согласие на обработку персональных данных может быть отозвано субъектом
      персональных данных путем подачи письменного заявления в адрес оператора
      одним из способов: по адресу электронной почты: {{ operatorEmail }} или по
      почтовому адресу, указанному напротив наименования оператора выше. В случае
      отзыва субъектом персональных данных согласия на обработку персональных
      данных оператор вправе продолжить обработку персональных данных без
      согласия субъекта персональных данных при наличии оснований, указанных в
      пп. 2–11 ч. 1 ст. 6, ч. 2 ст. 10 и ч. 2 ст. 11 Федерального закона от
      27.07.2006 № 152-ФЗ «О персональных данных».
    </p>
    <p>
      С полным текстом Политики обработки персональных данных Оператора,
      размещенной на настоящем сайте, ознакомлен(а).
    </p>
  </div>
  </DocModal>
</template>

<style scoped>
.consent-doc__table-wrap {
  overflow-x: auto;
  margin: 1rem 0;
}

.consent-doc__table {
  width: 100%;
  border-collapse: collapse;
  font-size: 0.875rem;
}

.consent-doc__table th,
.consent-doc__table td {
  border: 1px solid rgba(0, 0, 0, 0.15);
  padding: 0.75rem;
  text-align: left;
  vertical-align: top;
}

.consent-doc__table th {
  background: rgba(0, 0, 0, 0.05);
  font-weight: 600;
}

.consent-doc__table td:first-child {
  white-space: nowrap;
  width: 2rem;
}

.consent-doc__table th:nth-child(2),
.consent-doc__table td:nth-child(2) {
  min-width: 26rem;
  width: 48%;
}
.consent-doc__table th:nth-child(3),
.consent-doc__table td:nth-child(3) {
  min-width: 26rem;
}
</style>
