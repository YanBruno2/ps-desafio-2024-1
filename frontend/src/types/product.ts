import { categoryType } from './category'

export type productType = {
  id: string
  name: string
  quantity: number
  price: number
  image: string
  categoria_id: string
  category: categoryType
  created_at: Date
  updated_at: Date
}
