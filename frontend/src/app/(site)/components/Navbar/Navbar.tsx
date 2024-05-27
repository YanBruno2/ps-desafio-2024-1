'use client'
import Image from 'next/image'
import React, { useState } from 'react'
import './Navbar.css'

const Navbar = () => {
  const [page, setPage] = useState('')
  const [isDropdownVisible, setDropdownVisible] = useState(false)

  const handleDropdownToggle = () => {
    setDropdownVisible(!isDropdownVisible)
  }

  return (
    <div className="navbar">
      <Image
        src="/imagens/ScapeLogo-removebg-preview.png"
        className="logo"
        alt="Scape Logo"
        width={250} // Ajuste a largura conforme necessário
        height={250} // Ajuste a altura conforme necessário
      />
      <ul className="navbar-menu">
        <li
          onClick={() => setPage('menu')}
          className={page === 'menu' ? 'active' : ''}
        >
          menu
        </li>
        <li
          onClick={() => setPage('app-mobile')}
          className={page === 'app-mobile' ? 'active' : ''}
        >
          app-mobile
        </li>
        <li
          onClick={() => {
            setPage('categorias')
            handleDropdownToggle()
          }}
          className={page === 'categorias' ? 'active' : ''}
        >
          categorias
          {isDropdownVisible && (
            <ul className="dropdown-menu">
              <li onClick={() => setPage('perfumes')}>perfumes</li>
              <li onClick={() => setPage('cuidados-pessoais')}>
                cuidados pessoais
              </li>
              <li onClick={() => setPage('blusas')}>blusas</li>
              <li onClick={() => setPage('casacos')}>casacos</li>
              <li onClick={() => setPage('acessorios')}>acessórios</li>
              <li onClick={() => setPage('bolsas')}>bolsas</li>
              <li onClick={() => setPage('calcados')}>calçados</li>
              <li onClick={() => setPage('calcas')}>calças</li>
            </ul>
          )}
        </li>
        <li
          onClick={() => setPage('contatos')}
          className={page === 'contatos' ? 'active' : ''}
        >
          contatos
        </li>
      </ul>
      <div className="navbar-right">
        <Image
          src="/imagens/search_icon.png"
          alt="busca"
          width={25}
          height={25}
        />
        <div className="navbar-search-icon">
          <Image
            src="/imagens/basket_icon.png"
            alt="cesta"
            width={25}
            height={25}
          />
          <div className="dot"></div>
        </div>
        <button>sign in</button>
      </div>
    </div>
  )
}

export default Navbar
