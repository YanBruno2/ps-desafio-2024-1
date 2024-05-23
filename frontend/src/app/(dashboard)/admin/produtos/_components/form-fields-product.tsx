'use client'

import { Button } from '@/components/button'
import {
  FormFieldsGroup,
  FormField,
  ImageForm,
  handleImageChange,
} from '@/components/dashboard/form'
import { DialogFooter } from '@/components/dialog'
import { Input } from '@/components/input'
import { Label } from '@/components/label'
import { cn } from '@/lib/utils'
import { ResponseErrorType, api } from '@/services/api'
import { productType } from '@/types/product'
import { categoryType } from '@/types/category'
import React, { useEffect, useState } from 'react'
import { useFormStatus } from 'react-dom'

import { DashboardContainer } from '@/components/dashboard/dashboard-items'
import {
  Select,
  SelectContent,
  SelectGroup,
  SelectItem,
  SelectLabel,
  SelectTrigger,
  SelectValue,
} from '@radix-ui/react-select'

interface FormFieldsProductProps {
  product?: productType
  readOnly?: boolean
  error?: ResponseErrorType | null
}

export default function FormFieldsProduct({
  product,
  readOnly,
  error,
}: FormFieldsProductProps) {
  const { pending } = useFormStatus()
  const [updateImage, setUpdateImage] = useState<string | undefined>()
  const [category, setCategory] = useState<categoryType[]>()

  const requestData = async () => {
    try {
      const response: categoryType[] = await api.get('/categoria')
      setCategory(response)
    } catch (e) {
      return (
        <DashboardContainer className="text-destructive">
          Não foi possível obter as categorias
        </DashboardContainer>
      )
    }
  }

  useEffect(() => {
    requestData()
  }, [])

  return (
    <>
      <FormFieldsGroup>
        {product && (
          <Input defaultValue={product.id} type="text" name="id" hidden />
        )}
        <FormField>
          <Label htmlFor="name" required={!product}>
            Nome
          </Label>
          <Input
            name="name"
            id="name"
            placeholder="insira o nome de um produto"
            defaultValue={product?.name}
            disabled={pending}
            readOnly={readOnly}
            error={error?.errors?.name}
          />
        </FormField>
        <FormField>
          <Label htmlFor="quantity" required={!product}>
            Quantidade
          </Label>
          <Input
            type="number"
            name="quantity"
            id="quantity"
            placeholder="Insira a quantidade"
            defaultValue={product?.quantity}
            disabled={pending}
            readOnly={readOnly}
            error={error?.errors?.quantity}
          />
        </FormField>
        <FormField>
          <Label htmlFor="price" required={!product}>
            Preço
          </Label>
          <Input
            type="number"
            name="price"
            id="price"
            placeholder="Insira o preço"
            defaultValue={product?.price}
            disabled={pending}
            readOnly={readOnly}
            error={error?.errors?.price}
          />
        </FormField>
        <FormField>
          <Label
            htmlFor="image"
            hidden={readOnly && !product?.image}
            required={!product}
          >
            Imagem
          </Label>
          <Input
            name="image"
            id="image"
            type="file"
            accept="image/*"
            disabled={pending}
            hidden={readOnly}
            onChange={(e) => handleImageChange(e, setUpdateImage)}
            error={error?.errors?.image}
          />

          <ImageForm
            className="aspect-square"
            src={updateImage || product?.image}
          />
        </FormField>

        <FormField>
          <Label htmlFor="categoria_id" required={!product}>
            Categoria
          </Label>
          <Select
            disabled={pending}
            name="categoria_id"
            defaultValue={product?.categoria_id}
          >
            <SelectTrigger>
              <SelectValue placeholder="selecione a categoria que o produto pertence" />
            </SelectTrigger>
            <SelectContent id="categoria_id">
              <SelectGroup id="categoria_id">
                <SelectLabel>Categoria</SelectLabel>
                {category?.map((category: categoryType, index: number) => (
                  <SelectItem value={category.id} key={index}>
                    {category.name}
                  </SelectItem>
                ))}
              </SelectGroup>
            </SelectContent>
          </Select>
          {error?.errors?.categoria_id && (
            <p className="text-destructive text-xs mt-2">
              {error?.errors?.categoria_id}
            </p>
          )}
        </FormField>
      </FormFieldsGroup>
      <DialogFooter className={cn({ hidden: readOnly })}>
        <Button type="submit" pending={pending}>
          Salvar
        </Button>
      </DialogFooter>
    </>
  )
}
