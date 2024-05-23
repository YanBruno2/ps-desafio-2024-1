'use server'

import { api } from '@/services/api'
import { revalidatePath } from 'next/cache'

export async function createProduct(form: FormData) {
  try {
    await api.post('/produto', form)
  } catch (e) {
    return JSON.stringify(e)
  }
  revalidatePath('/admin/produtos')
}

export async function updateProduct(form: FormData) {
  try {
    await api.post(`/produto/${form.get('$id')}`, form)
  } catch (e) {
    return JSON.stringify(e)
  }
  revalidatePath('/admin/produtos')
}

export async function destroyProduct(id: string) {
  await api.delete(`/produto/${id}`)
  revalidatePath('/admin/produtos')
}
