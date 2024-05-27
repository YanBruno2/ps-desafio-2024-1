'use client'
import React from 'react'
import Navbar from './components/Navbar/Navbar'
import Header from './components/Header/Header'
import Footer from './components/Footer/Footer'
import Appdownload from './components/Appdownload/Appdownload'

const page = () => {
  return (
    <>
      <div className="home">
        <Navbar />
        <Header />
        <Appdownload />
        <Footer />
      </div>
    </>
  )
}

export default page

// Função não implementada, ela iria diminuir a quantidade de produtos.
/* 'use client'
import { api } from '@/services/api'
import { categoryType } from '@/types/category'
import { useEffect, useState } from 'react'

export default function Home() {
  const [categoria, setCategory] = useState<categoryType[] | null>(null)

  const requestData = async () => {
    try {
      const response: categoryType[] = await api.get('categoria')
      setCategory(response)
    } catch (e) {
      console.error(`Error fetching data: ${e}`)
    }
  }

  useEffect(() => {
    requestData()
  }, [])

  return (
    <div>
      {categoria?.map((categoria: categoryType, index: number) => (
        <h1 key={index}>{categoria.name}</h1>
      ))}
    </div>
  )
}
*/
