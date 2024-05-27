import React from 'react'
import './Appdownload.css'
import Image from 'next/image'
function Appdownload() {
  return (
    <div className="app-download" id="app-download">
      <p>
        Para Uma Melhor Experiência Baixe <br /> Scape app
      </p>
      <div className="app-download-platforms">
        <Image
          src="/imagens/app_store.png"
          alt="app store"
          className="app"
          width={100}
          height={10}
        />
        <Image
          src="/imagens/play_store.png"
          alt="play store"
          className="app"
          width={100}
          height={25}
        />
      </div>
    </div>
  )
}

export default Appdownload
