'use server'

import { api } from '@/services/api'
import { revalidatePath } from 'next/cache'

export async function createCategory(form: FormData) {
  try {
    await api.post('/categoria', form)
  } catch (e) {
    return JSON.stringify(e)
  }
  revalidatePath('/admin/categorias')
}

//  atualizar uma mesma categoria por meio do mesmo id

export async function updateCategory(form: FormData) {
  try {
    await api.post(`/categoria/${form.get('$id')}`, form)
  } catch (e) {
    return JSON.stringify(e)
  }
  revalidatePath('/admin/categorias')
}
// deleta uma categoria por meio de sua id
export async function destroyCategory(id: string) {
  await api.delete(`/categoria/${id}`)
  revalidatePath('/admin/categorias')
}
