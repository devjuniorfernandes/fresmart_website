import os
import sys
from reportlab.lib.pagesizes import A4
from reportlab.lib import colors
from reportlab.platypus import (
    SimpleDocTemplate, Paragraph, Spacer, Table, TableStyle, PageBreak, KeepTogether, HRFlowable
)
from reportlab.lib.styles import getSampleStyleSheet, ParagraphStyle
from reportlab.lib.enums import TA_CENTER, TA_LEFT, TA_RIGHT, TA_JUSTIFY

def build_pdf(filename):
    doc = SimpleDocTemplate(
        filename,
        pagesize=A4,
        rightMargin=36,
        leftMargin=36,
        topMargin=40,
        bottomMargin=40
    )

    styles = getSampleStyleSheet()

    # Custom Palette
    PRIMARY = colors.HexColor("#45B500")      # Fresmart Green
    PRIMARY_DARK = colors.HexColor("#338800")
    DARK_TEXT = colors.HexColor("#1E293B")     # Slate 800
    MUTED_TEXT = colors.HexColor("#64748B")    # Slate 500
    LIGHT_BG = colors.HexColor("#F8FAFC")      # Slate 50
    HEADER_BG = colors.HexColor("#0F172A")    # Slate 900
    BORDER_COLOR = colors.HexColor("#E2E8F0")

    # Typography Styles
    title_style = ParagraphStyle(
        'DocTitle',
        parent=styles['Normal'],
        fontName='Helvetica-Bold',
        fontSize=20,
        leading=24,
        textColor=colors.white,
        alignment=TA_LEFT
    )

    subtitle_style = ParagraphStyle(
        'DocSubtitle',
        parent=styles['Normal'],
        fontName='Helvetica',
        fontSize=10,
        leading=14,
        textColor=colors.HexColor("#E2E8F0"),
        alignment=TA_LEFT
    )

    section_heading = ParagraphStyle(
        'SectionHeading',
        parent=styles['Normal'],
        fontName='Helvetica-Bold',
        fontSize=13,
        leading=17,
        textColor=PRIMARY_DARK,
        spaceBefore=14,
        spaceAfter=6
    )

    body_style = ParagraphStyle(
        'BodyDark',
        parent=styles['Normal'],
        fontName='Helvetica',
        fontSize=9,
        leading=13,
        textColor=DARK_TEXT
    )

    body_bold = ParagraphStyle(
        'BodyDarkBold',
        parent=styles['Normal'],
        fontName='Helvetica-Bold',
        fontSize=9,
        leading=13,
        textColor=DARK_TEXT
    )

    table_header = ParagraphStyle(
        'TableHeader',
        parent=styles['Normal'],
        fontName='Helvetica-Bold',
        fontSize=8.5,
        leading=11,
        textColor=colors.white,
        alignment=TA_LEFT
    )

    table_cell = ParagraphStyle(
        'TableCell',
        parent=styles['Normal'],
        fontName='Helvetica',
        fontSize=8.5,
        leading=11,
        textColor=DARK_TEXT
    )

    table_cell_bold = ParagraphStyle(
        'TableCellBold',
        parent=styles['Normal'],
        fontName='Helvetica-Bold',
        fontSize=8.5,
        leading=11,
        textColor=DARK_TEXT
    )

    badge_style = ParagraphStyle(
        'BadgeStyle',
        parent=styles['Normal'],
        fontName='Helvetica-Bold',
        fontSize=8,
        leading=10,
        textColor=PRIMARY_DARK
    )

    elements = []

    # --- HEADER BANNER ---
    header_data = [
        [
            Paragraph("FRESMART WEBSITE", title_style),
            Paragraph("Guia Oficial de Especificações<br/>Edição 2026", ParagraphStyle('RightSub', parent=subtitle_style, alignment=TA_RIGHT))
        ],
        [
            Paragraph("GUIA DE DIMENSÕES & ESPECIFICAÇÕES DE IMAGENS", subtitle_style),
            Paragraph("Suporte Técnico CMS", ParagraphStyle('RightSub2', parent=subtitle_style, alignment=TA_RIGHT))
        ]
    ]

    header_table = Table(header_data, colWidths=[340, 183])
    header_table.setStyle(TableStyle([
        ('BACKGROUND', (0,0), (-1,-1), HEADER_BG),
        ('PADDING', (0,0), (-1,-1), 12),
        ('BOTTOMPADDING', (0,1), (-1,1), 14),
        ('VALIGN', (0,0), (-1,-1), 'MIDDLE'),
        ('LINEBELOW', (0,1), (-1,1), 4, PRIMARY),
    ]))

    elements.append(header_table)
    elements.append(Spacer(1, 14))

    # --- INTRO TEXT ---
    intro_p = Paragraph(
        "Este guia prático fornece as especificações exatas (dimensões em pixels, proporções de aspeto, formatos recomendados e tamanhos máximos de ficheiro) para o carregamento de imagens no **CMS do Website Fresmart**. Seguir estas recomendações garante um visual cristalino em computadores e telemóveis com velocidade de carregamento otimizada.",
        body_style
    )
    elements.append(intro_p)
    elements.append(Spacer(1, 10))

    def create_table(data, widths=[130, 95, 75, 115, 108]):
        formatted_data = []
        # Header row
        header_row = [Paragraph(cell, table_header) for cell in data[0]]
        formatted_data.append(header_row)

        for row in data[1:]:
            formatted_row = []
            for idx, cell in enumerate(row):
                if idx == 0:
                    formatted_row.append(Paragraph(cell, table_cell_bold))
                elif idx == 1:
                    formatted_row.append(Paragraph(f"<b>{cell}</b>", table_cell))
                else:
                    formatted_row.append(Paragraph(cell, table_cell))
            formatted_data.append(formatted_row)

        t = Table(formatted_data, colWidths=widths)
        t.setStyle(TableStyle([
            ('BACKGROUND', (0,0), (-1,0), PRIMARY_DARK),
            ('ALIGN', (0,0), (-1,-1), 'LEFT'),
            ('VALIGN', (0,0), (-1,-1), 'MIDDLE'),
            ('PADDING', (0,0), (-1,-1), 6),
            ('GRID', (0,0), (-1,-1), 0.5, BORDER_COLOR),
            ('ROWBACKGROUNDS', (0,1), (-1,-1), [colors.white, LIGHT_BG]),
        ]))
        return t

    # --- SECTION 1: HOME PAGE ---
    elements.append(Paragraph("1. 🏠 PÁGINA INICIAL (HOME)", section_heading))
    home_data = [
        ["Secção / Elemento", "Dimensão Ideal (px)", "Proporção", "Formato Recomendado", "Tamanho Máx."],
        ["Hero Slider Principal (Desktop)", "1920 × 600 px", "16:5 / Panorâmico", "WebP / JPG (80%)", "< 350 KB"],
        ["Hero Slider Principal (Mobile)", "800 × 500 px", "16:10", "WebP / JPG", "< 150 KB"],
        ["Campanhas - Cards Grandes (Item 0 e 4)", "800 × 960 px", "~4:5 / Vertical", "WebP / JPG", "< 200 KB"],
        ["Campanhas - Card Médio (Item 1)", "1200 × 500 px", "~16:7 / Horizontal", "WebP / JPG", "< 180 KB"],
        ["Campanhas - Cards Pequenos (Item 2 e 3)", "600 × 500 px", "~6:5 / Quadrado", "WebP / JPG", "< 120 KB"],
        ["Banner Promocional (Fim da Home)", "1920 × 360 px", "16:3 Responsivo", "WebP / PNG / JPG", "< 250 KB"],
    ]
    elements.append(create_table(home_data))
    elements.append(Spacer(1, 12))

    # --- SECTION 2: PÁGINAS INSTITUCIONAIS ---
    elements.append(Paragraph("2. 📄 PÁGINAS INSTITUCIONAIS (Quem Somos, Carreiras, etc.)", section_heading))
    inst_data = [
        ["Secção / Elemento", "Dimensão Ideal (px)", "Proporção", "Formato Recomendado", "Tamanho Máx."],
        ["Banner de Cabeçalho / Capa de Página", "1920 × 450 px", "~16:4", "WebP / JPG", "< 250 KB"],
        ["Imagens Internas Quem Somos (Armazém)", "1000 × 667 px", "3:2", "WebP / JPG", "< 150 KB"],
        ["Imagens de Equipa / Cultura (Carreiras)", "800 × 600 px", "4:3", "WebP / JPG", "< 130 KB"],
        ["Ilustração Sustentabilidade / Resp. Social", "1000 × 667 px", "3:2", "WebP / JPG", "< 150 KB"],
    ]
    elements.append(create_table(inst_data))
    elements.append(Spacer(1, 12))

    # --- SECTION 3: PRODUTOS, RECEITAS, NOTÍCIAS & LOJAS ---
    elements.append(Paragraph("3. 🛍️ PRODUTOS, RECEITAS, NOTÍCIAS & LOJAS", section_heading))
    prod_data = [
        ["Secção / Elemento", "Dimensão Ideal (px)", "Proporção", "Formato Recomendado", "Tamanho Máx."],
        ["Cards de Departamentos / Produtos", "800 × 600 px", "4:3", "WebP / JPG", "< 120 KB"],
        ["Imagens de Receitas (Grelha)", "800 × 600 px", "4:3 / 1:1", "WebP / JPG", "< 120 KB"],
        ["Capa de Artigos & Notícias", "1200 × 675 px", "16:9", "WebP / JPG", "< 150 KB"],
        ["Fotos das Lojas (Localizador)", "800 × 500 px", "16:10", "WebP / JPG", "< 100 KB"],
        ["Logótipo Oficial (Header / Footer)", "400 × 120 px", "Livre / Vetorial", "SVG ou PNG Transparente", "< 50 KB"],
    ]
    elements.append(create_table(prod_data))
    elements.append(Spacer(1, 14))

    # --- SECTION 4: BOAS PRÁTICAS & OTIMIZAÇÃO ---
    elements.append(Paragraph("4. 💡 GUIA DE OTIMIZAÇÃO & BOAS PRÁTICAS", section_heading))

    tips_data = [
        [
            Paragraph("<b>1. Formato Preferencial (WebP)</b>", body_bold),
            Paragraph("O formato <b>.webp</b> oferece uma redução de peso até <b>70%</b> em relação ao JPG/PNG mantendo a mesma qualidade visual.", body_style)
        ],
        [
            Paragraph("<b>2. Perfil de Cor sRGB</b>", body_bold),
            Paragraph("Assegurar que todas as imagens são guardadas em <b>sRGB</b> para garantir cores fiéis em ecrãs móveis e computadores.", body_style)
        ],
        [
            Paragraph("<b>3. Compressão Prévia</b>", body_bold),
            Paragraph("Antes de carregar no CMS, passe as imagens em ferramentas gratuitas como <b>TinyPNG (tinypng.com)</b> ou <b>Squoosh (squoosh.app)</b>.", body_style)
        ],
        [
            Paragraph("<b>4. Textos em Imagens</b>", body_bold),
            Paragraph("Em banners promocionais, mantenha os textos principais centralizados para evitar cortes em ecrãs de telemóvel.", body_style)
        ]
    ]

    tips_table = Table(tips_data, colWidths=[160, 363])
    tips_table.setStyle(TableStyle([
        ('BACKGROUND', (0,0), (-1,-1), LIGHT_BG),
        ('PADDING', (0,0), (-1,-1), 8),
        ('GRID', (0,0), (-1,-1), 0.5, BORDER_COLOR),
        ('VALIGN', (0,0), (-1,-1), 'TOP'),
    ]))

    elements.append(tips_table)

    # --- FOOTER STYLING ---
    def add_footer(canvas, doc):
        canvas.saveState()
        canvas.setFont('Helvetica', 8)
        canvas.setFillColor(MUTED_TEXT)
        canvas.drawString(36, 20, "Fresmart Website • Guia Técnico de Imagens para CMS")
        canvas.drawRightString(559, 20, f"Página {doc.page}")
        canvas.setStrokeColor(BORDER_COLOR)
        canvas.setLineWidth(0.5)
        canvas.line(36, 32, 559, 32)
        canvas.restoreState()

    doc.build(elements, onFirstPage=add_footer, onLaterPages=add_footer)
    print(f"PDF successfully generated: {filename}")

if __name__ == '__main__':
    out_file = sys.argv[1] if len(sys.argv) > 1 else "Guia_Dimensoes_Imagens_Fresmart.pdf"
    build_pdf(out_file)
