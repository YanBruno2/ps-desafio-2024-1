'use client'
import Image from 'next/image'
import React from 'react'
import './Footer.css'

const Footer = () => {
  return (
    <div className="footer" id="footer">
      <div className="footer-content">
        <div className="footer-content-left">
          <Image
            src="/imagens/ScapeLogo-removebg-preview.png "
            alt=""
            className="logo"
            width={200}
            height={200}
          />
          <p>
            Para homens que se vestem de forma autêntica e vivem a aventura da
            vida com confiança. Fuja da zona de conforto, do tradicional e do
            formal. Scape Streetwear é a nossa marca, seu escape na moda.
          </p>
          <div className="footer-social-icons">
            <Image
              src="/imagens/facebook_icon.png"
              alt=""
              width={40}
              height={40}
            />
            <Image
              src="/imagens/twitter_icon.png"
              alt=""
              width={40}
              height={40}
            />
            <Image
              src="/imagens/linkedin_icon.png"
              alt=""
              width={40}
              height={40}
            />
          </div>
        </div>
        <div className="footer-content-center">
          <h2>COMPANHIA</h2>
          <ul>
            <li>Home</li>
            <li>Sobre nós</li>
            <li>Envio</li>
            <li>Política de privacidade</li>
          </ul>
        </div>

        <div className="footer-content-right">
          <h2>ENTRE EM CONTATO</h2>
          <ul>
            <li>21 9-87986798</li>
            <li>contato@scapestreetwear.com</li>
          </ul>
        </div>
      </div>
      <hr />
      <p className="footer-copyright">
        {' '}
        Copyright 2024 © Scape.com - Todos Direitos Reservados.
      </p>
    </div>
  )
}

export default Footer
