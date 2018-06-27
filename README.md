# 概要

このプロジェクトはWEBデザイン事務所トキヨリが行う
**主な開発フローのご紹介**と[トキヨリ コーポレートサイト](https://tokiyori.jp)のコードを一般公開し
当事務所の**コーディングに対するコンセプト・仕様をご紹介**する為に存在します。

## 開発フロー

開発は基本的に複数人で行います。
プロジェクト管理は[Backlog](https://backlog.com/ja/)を使用し、Backlogのリポジトリにてバージョン管理ツールである[Git](https://ja.wikipedia.org/wiki/Git)を使用します。
コミュニケーションツールとしては
- [Slack](https://slack.com/intl/ja-jp/lp/two?cvosrc=ppc.google.d_ppc_google_ja_jp_brand-hv&cvo_creative=257450954142&utm_medium=ppc&utm_source=google&utm_campaign=d_ppc_google_ja_jp_brand-hv&utm_term=slack&cvosrc=ppc.google.slack&cvo_campaign=&cvo_crid=257450954142&Matchtype=e&utm_source=google&utm_medium=ppc&c3api=5523,257450954142,slack&gclid=CjwKCAjwyMfZBRAXEiwA-R3gM26X8rhx4H1K8ixcQM1HoHRAaPgXHeMI9DWIVWcIyr70nMev-JZrixoCQosQAvD_BwE&gclsrc=aw.ds&dclid=CLSX-66t8dsCFZcxKgodHFMGug)
- [ChatWork](https://go.chatwork.com/ja/?adcode=fscwpcsemgognonjp0006&utm_source=google&utm_medium=cpc&utm_campaign=conflict&utm_term=slack&utm_content=277443657024)
- Facebook Messenger
- Mail
上記4ツールを使用することが多いです。
テスト環境が必要な場合は当事務所が契約をしているサーバにて環境を準備致します。



## コーディングコンセプト

メンテナンス性、効率を意識したコーディングを心がけます。
拡張性、再利用性、柔軟性、ルールを持たせます。
要素の追加・削除のし易さを意識します。
制作の環境に合わせて適宜調整します。

### 推奨開発環境

[![node](https://img.shields.io/badge/node-v8.11.3-green.svg "node v5.5.0")](https://nodejs.org/ja/)
[![npm](https://img.shields.io/badge/npm-v5.6.0-orange.svg "npm v3.3.12")](https://www.npmjs.com/)
[![ruby](https://img.shields.io/badge/ruby-v2.2.0-red.svg "ruby v2.2.0")](https://www.ruby-lang.org/ja/)
[![bundle](https://img.shields.io/badge/bundle-v1.13.7-yellow.svg "bundle v1.13.7")](http://railsdoc.com/references/bundle)

### 対応ブラウザ

Internet Explorer11、Microsoft Edge 最新ver、Firefox 最新ver、Chrome 最新ver Safari 最新ver
スマートフォンOSに搭載されている標準のブラウザ
旧ブラウザは閲覧性を重視します。

### 命名規則

#### 共通

単語の繋ぎはハイフン「 - 」を使用します。

#### HTML

ファイル名はページタイトルを英語化します。

#### CSS

BEM記法、マルチクラス

- ````[塊]__[要素]--[属性]````
- ````[接頭辞]-[塊]__[要素]--[属性]````

````
<div class="unit">
     <div class="unit__header">
      <h2 class-"unit__title">タイトル</h2>
     </div>
     <div class="unit__body">
         <ul class="list list--disc">
           <li class="list__item">テキスト</li>
           <li class="list__item">テキスト</li>
         </ul>
     </div>
 </div>
````

#### img

固有のClass名がある場合は同じファイル名でも良いです。

- ````[要素]_[属性]_[連番]````
- ````[接頭辞]-[要素]_[属性]_[連番]````
