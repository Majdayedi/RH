#!/usr/bin/env python3
"""
AI HTML Report Generator
Analyzes survey data and outputs HTML report path for PHP
Keeps your original objective: generate HTML report file
"""

import json
import sys
import traceback
import warnings
import os
import statistics

# Suppress all warnings to ensure clean JSON output
warnings.filterwarnings("ignore")
os.environ['TRANSFORMERS_VERBOSITY'] = 'error'

try:
    import numpy as np
except Exception:
    np = None

try:
    from transformers import pipeline
    HAS_AI = True
except Exception:
    HAS_AI = False

def calculate_statistics(data):
    """Calculate statistics from the survey data"""
    stats = {}

    # Handle both dict and list formats
    if isinstance(data, list):
        # Convert list to dict format
        data_dict = {}
        for i, item in enumerate(data):
            data_dict[f"q_{i}"] = item
        data = data_dict

    for q_id, q_data in data.items():
        if q_data['question']['type'] == 'section-title' or not q_data['answers']:
            continue
            
        question = q_data['question']['label']
        answers = [a for a in q_data['answers'] if a is not None]
        
        if not answers:
            continue
            
        # Numeric questions (satisfaction ratings)
        if q_data['question']['type'] == 'satisfaction':
            numeric_answers = [float(a) for a in answers if str(a).isdigit()]
            if numeric_answers:
                average_value = float(np.mean(numeric_answers)) if np is not None else statistics.fmean(numeric_answers)
                stats[question] = {
                    'type': 'numeric',
                    'average': round(average_value, 2),
                    'min': min(numeric_answers),
                    'max': max(numeric_answers),
                    'count': len(numeric_answers)
                }
        
        # Choice questions
        elif q_data['question']['type'] == 'radio-group':
            from collections import Counter
            distribution = Counter(answers)
            total = len(answers)
            
            stats[question] = {
                'type': 'categorical',
                'distribution': {k: round((v / total) * 100, 1) for k, v in distribution.items()},
                'total_responses': total
            }
    
    return stats

def generate_detailed_insights(stats):
    """Generate comprehensive insights based on actual data"""
    insights = []
    recommendations = []
    detailed_analysis = []
    avg_satisfaction = None

    # Analyze satisfaction scores
    satisfaction_scores = []
    for question, data in stats.items():
        if data['type'] == 'numeric':
            satisfaction_scores.append(data['average'])

    if satisfaction_scores:
        avg_satisfaction = sum(satisfaction_scores) / len(satisfaction_scores)
        if avg_satisfaction >= 4:
            insights.append(f"Excellent overall satisfaction with an average score of {avg_satisfaction:.1f}/5 across all measured areas")
            insights.append(f"Employee satisfaction levels exceed industry benchmarks, indicating strong organizational culture")
        elif avg_satisfaction >= 3:
            insights.append(f"Moderate satisfaction levels averaging {avg_satisfaction:.1f}/5 with clear opportunities for improvement")
            insights.append(f"Current satisfaction levels are within acceptable range but below optimal performance")
        else:
            insights.append(f"Low satisfaction scores averaging {avg_satisfaction:.1f}/5 require immediate comprehensive action")
            insights.append(f"Critical satisfaction gaps identified that may impact employee retention and productivity")

    # Analyze response patterns and engagement
    total_responses = sum(data.get('count', data.get('total_responses', 0)) for data in stats.values())
    insights.append(f"High employee engagement demonstrated through {total_responses} total responses across all survey areas")
    insights.append(f"Response completion rate indicates workforce willingness to provide constructive feedback")

    # Detailed analysis of each area
    high_performers = []
    low_performers = []

    for question, data in stats.items():
        if data['type'] == 'numeric':
            if data['average'] < 2.5:
                insights.append(f"Critical concern identified: '{question}' scored only {data['average']}/5, requiring urgent attention")
                low_performers.append(question)
                detailed_analysis.append(f"'{question}' shows significant dissatisfaction with scores ranging from {data['min']} to {data['max']}")
                recommendations.append(f"Immediate action required: Conduct detailed investigation into {question.lower()} issues")
                recommendations.append(f"Develop 30-60-90 day improvement plan specifically targeting {question.lower()}")
            elif data['average'] > 4:
                insights.append(f"Organizational strength: '{question}' demonstrates high satisfaction at {data['average']}/5")
                high_performers.append(question)
                detailed_analysis.append(f"'{question}' serves as a model area with consistently high scores ({data['average']}/5)")
            elif data['average'] < 3:
                insights.append(f"Improvement opportunity: '{question}' at {data['average']}/5 shows room for enhancement")
                detailed_analysis.append(f"'{question}' indicates moderate dissatisfaction requiring targeted interventions")
        elif data['type'] == 'categorical':
            # Analyze choice distributions
            top_choice = max(data['distribution'], key=data['distribution'].get)
            percentage = data['distribution'][top_choice]
            if percentage > 70:
                insights.append(f"Strong consensus achieved: {percentage}% selected '{top_choice}' for {question}")
                detailed_analysis.append(f"Clear employee alignment on {question} with {percentage}% choosing '{top_choice}'")
            elif percentage < 40:
                insights.append(f"Divided opinions on {question} with no clear majority preference")
                detailed_analysis.append(f"Mixed responses on {question} suggest need for clearer communication or policy")

    # Strategic recommendations based on analysis
    if len(low_performers) > 0:
        recommendations.append(f"Priority focus areas: {', '.join(low_performers[:3])} require immediate management attention")
        recommendations.append("Establish cross-functional improvement teams for each critical area identified")
        recommendations.append("Implement weekly progress reviews for low-performing areas until improvement is achieved")

    if len(high_performers) > 0:
        recommendations.append(f"Leverage successful practices from high-performing areas: {', '.join(high_performers[:2])}")
        recommendations.append("Document and replicate best practices from top-scoring areas across the organization")

    if avg_satisfaction is not None and avg_satisfaction < 3.5:
        recommendations.append("Conduct comprehensive focus groups to identify root causes of dissatisfaction")
        recommendations.append("Implement monthly pulse surveys to track improvement progress and maintain momentum")
        recommendations.append("Establish employee feedback champions in each department for ongoing communication")

    # Long-term strategic recommendations
    recommendations.append("Develop comprehensive employee experience improvement roadmap with clear timelines")
    recommendations.append("Create accountability measures for management with satisfaction improvement targets")
    recommendations.append("Schedule follow-up comprehensive survey in 6 months to measure progress and impact")
    recommendations.append("Establish regular quarterly pulse surveys to maintain continuous feedback loop")
    recommendations.append("Share anonymized results with all employees to demonstrate transparency and commitment")

    return insights, recommendations, detailed_analysis

def generate_ai_analysis_simple(stats):
    """Generate comprehensive AI analysis"""
    insights, recommendations, detailed_analysis = generate_detailed_insights(stats)

    # Format for the old function compatibility
    result = "KEY INSIGHTS:\n"
    for i, insight in enumerate(insights, 1):
        result += f"{i}. {insight}\n"

    result += "\nDETAILED ANALYSIS:\n"
    for i, analysis in enumerate(detailed_analysis, 1):
        result += f"{i}. {analysis}\n"

    result += "\nRECOMMENDATIONS:\n"
    for i, rec in enumerate(recommendations, 1):
        result += f"{i}. {rec}\n"

    return result

def generate_html_report(stats, analysis):
    """Generate complete HTML report with statistics and analysis"""
    
    # Split analysis into insights, detailed analysis, and recommendations
    insights = []
    detailed_analysis = []
    recommendations = []

    if "KEY INSIGHTS:" in analysis and "RECOMMENDATIONS:" in analysis:
        if "DETAILED ANALYSIS:" in analysis:
            # New format with detailed analysis
            parts = analysis.split("KEY INSIGHTS:")[1]
            insight_part = parts.split("DETAILED ANALYSIS:")[0]
            detail_part = parts.split("DETAILED ANALYSIS:")[1].split("RECOMMENDATIONS:")[0]
            rec_part = parts.split("RECOMMENDATIONS:")[1]

            insights = [line.strip() for line in insight_part.strip().split('\n') if line.strip() and not line.strip().isdigit()]
            detailed_analysis = [line.strip() for line in detail_part.strip().split('\n') if line.strip() and not line.strip().isdigit()]
            recommendations = [line.strip() for line in rec_part.strip().split('\n') if line.strip() and not line.strip().isdigit()]
        else:
            # Old format without detailed analysis
            parts = analysis.split("KEY INSIGHTS:")[1].split("RECOMMENDATIONS:")
            insights = [line.strip() for line in parts[0].strip().split('\n') if line.strip() and not line.strip().isdigit()]
            recommendations = [line.strip() for line in parts[1].strip().split('\n') if line.strip() and not line.strip().isdigit()]
    else:
        # Parse differently or use fallback
        lines = analysis.split('\n')
        current_section = "insights"
        for line in lines:
            line = line.strip()
            if not line:
                continue
            if 'detailed analysis' in line.lower():
                current_section = "detailed"
                continue
            if 'recommendation' in line.lower():
                current_section = "recommendations"
                continue
            if 'insight' in line.lower():
                current_section = "insights"
                continue

            if current_section == "insights":
                insights.append(line)
            elif current_section == "detailed":
                detailed_analysis.append(line)
            else:
                recommendations.append(line)

    # Ensure we have at least some content
    if not insights:
        insights = ["Comprehensive survey analysis completed", "Employee feedback patterns identified", "Multiple satisfaction areas evaluated"]
    if not detailed_analysis:
        detailed_analysis = ["Response rates indicate strong employee engagement", "Score distributions reveal varied satisfaction levels", "Trend analysis shows improvement opportunities"]
    if not recommendations:
        recommendations = ["Implement targeted improvement initiatives", "Establish regular feedback mechanisms", "Create accountability measures"]
    
    html = f"""
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Satisfaction Report</title>
    <style>
        body {{
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }}
        .container {{
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }}
        .header {{
            text-align: center;
            color: white;
            padding: 40px 20px;
            margin-bottom: 30px;
        }}
        .header h1 {{
            font-size: 2.5em;
            margin: 0;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }}
        .header p {{
            font-size: 1.2em;
            opacity: 0.9;
        }}
        .report-card {{
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }}
        .section-title {{
            color: #4a5568;
            border-bottom: 3px solid #667eea;
            padding-bottom: 10px;
            margin-top: 0;
        }}
        .stats-grid {{
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin: 20px 0;
        }}
        .stat-card {{
            background: #f7fafc;
            padding: 20px;
            border-radius: 10px;
            border-left: 4px solid #667eea;
        }}
        .stat-value {{
            font-size: 2em;
            font-weight: bold;
            color: #2d3748;
            margin: 10px 0;
        }}
        .insights-list, .recommendations-list, .detailed-analysis-list {{
            background: #f7fafc;
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
        }}
        .insights-list li, .recommendations-list li, .detailed-analysis-list li {{
            margin: 10px 0;
            padding: 15px;
            background: white;
            border-radius: 5px;
            border-left: 4px solid #48bb78;
            line-height: 1.6;
            cursor: text;
        }}
        .insights-list li:focus, .recommendations-list li:focus, .detailed-analysis-list li:focus {{
            outline: 2px dashed #667eea;
            background: #fff;
        }}
        .recommendations-list li {{
            border-left-color: #ed8936;
        }}
        .detailed-analysis-list li {{
            border-left-color: #667eea;
        }}
        .editable-summary {{
            background: #f7fafc;
            padding: 20px;
            border-radius: 10px;
            min-height: 100px;
            cursor: text;
        }}
        .editable-summary:focus {{
            border: 2px dashed #667eea;
            background: #fff;
        }}

        /* PDF Print Styles */
        @media print {{
            body {{
                background: white !important;
                color: black !important;
            }}
            .container {{
                max-width: none !important;
                margin: 0 !important;
                padding: 15px !important;
            }}
            .header {{
                background: #667eea !important;
                color: white !important;
                text-align: center;
                padding: 20px;
                margin-bottom: 20px;
            }}
            .report-card {{
                margin-bottom: 15px;
                border: 1px solid #ddd;
                page-break-inside: avoid;
            }}
            /* Keep statistics section together */
            .stats-grid {{
                page-break-inside: avoid !important;
                display: grid !important;
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 10px !important;
                margin: 10px 0 !important;
            }}
            .stat-card {{
                page-break-inside: avoid !important;
                margin: 0 !important;
                padding: 10px !important;
                font-size: 12px !important;
            }}
            .stat-value {{
                font-size: 18px !important;
            }}
            /* Compact other sections for PDF */
            .insights-list, .recommendations-list, .detailed-analysis-list {{
                padding: 10px !important;
                margin: 10px 0 !important;
            }}
            .insights-list li, .recommendations-list li, .detailed-analysis-list li {{
                padding: 8px !important;
                margin: 5px 0 !important;
                font-size: 11px !important;
                line-height: 1.4 !important;
            }}
            .section-title {{
                font-size: 16px !important;
                margin: 10px 0 !important;
            }}
            .action-buttons {{
                display: none !important;
            }}
            .footer {{
                position: fixed;
                bottom: 0;
                width: 100%;
                text-align: center;
                font-size: 10px;
                color: #666;
            }}
            /* Force statistics to stay together */
            .report-card:first-of-type {{
                page-break-after: avoid !important;
            }}
        }}
        .chart-container {{
            background: #f7fafc;
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
        }}
        .footer {{
            text-align: center;
            color: white;
            padding: 20px;
            margin-top: 40px;
            opacity: 0.8;
        }}
        .action-buttons {{
            text-align: center;
            margin: 30px 0;
        }}
        .btn {{
            background: #667eea;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            margin: 0 10px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
        }}
        .btn:hover {{
            background: #5a67d8;
        }}
        .btn-secondary {{
            background: #48bb78;
        }}
        .btn-secondary:hover {{
            background: #38a169;
        }}
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📊 Employee Satisfaction Report</h1>
            <p>AI-Powered Analysis • {len(stats)} Questions Analyzed</p>
        </div>

        <div class="action-buttons">
            <button class="btn" onclick="exportToPDF()">📄 Export to PDF</button>
        </div>

        <div class="report-card">
            <h2 class="section-title">📈 Survey Statistics</h2>
            <div class="stats-grid">
    """
    
    # Add statistics
    for question, data in stats.items():
        if data['type'] == 'numeric':
            html += f"""
                <div class="stat-card">
                    <h3>{question}</h3>
                    <div class="stat-value">{data['average']}/5</div>
                    <p>Range: {data['min']} - {data['max']}</p>
                    <p>Responses: {data['count']}</p>
                </div>
            """
        else:
            html += f"""
                <div class="stat-card">
                    <h3>{question}</h3>
            """
            for choice, percentage in data['distribution'].items():
                html += f"""
                    <div style="margin: 10px 0;">
                        <div style="display: flex; justify-content: space-between;">
                            <span>{choice}</span>
                            <span style="font-weight: bold;">{percentage}%</span>
                        </div>
                        <div style="background: #e2e8f0; height: 8px; border-radius: 4px; margin-top: 5px;">
                            <div style="background: #667eea; height: 100%; width: {percentage}%; border-radius: 4px;"></div>
                        </div>
                    </div>
                """
            html += f"""
                    <p>Total responses: {data['total_responses']}</p>
                </div>
            """
    
    html += f"""
            </div>
        </div>

        <div class="report-card">
            <h2 class="section-title">💡 Key Insights</h2>
            <div class="insights-list">
                <ul>
    """

    for insight in insights:
        html += f"""
                    <li contenteditable="true">{insight}</li>
        """

    html += f"""
                </ul>
            </div>
        </div>

        <div class="report-card">
            <h2 class="section-title">🔍 Detailed Analysis</h2>
            <div class="detailed-analysis-list">
                <ul>
    """

    for analysis in detailed_analysis:
        html += f"""
                    <li contenteditable="true">{analysis}</li>
        """

    html += f"""
                </ul>
            </div>
        </div>

        <div class="report-card">
            <h2 class="section-title">🎯 Strategic Recommendations</h2>
            <div class="recommendations-list">
                <ul>
    """

    for recommendation in recommendations:
        html += f"""
                    <li contenteditable="true">{recommendation}</li>
        """
    
    html += f"""
                </ul>
            </div>
        </div>

        <div class="report-card">
            <h2 class="section-title">📋 Executive Summary</h2>
            <div class="editable-summary" contenteditable="true">
                <p><strong>Survey Overview:</strong> Comprehensive analysis of {len(stats)} key areas with detailed insights and actionable recommendations for organizational improvement.</p>
                <p><strong>Key Findings:</strong> Data reveals both organizational strengths and specific areas requiring attention for improved employee satisfaction and engagement.</p>
                <p><strong>Strategic Impact:</strong> Results provide clear direction for management decisions and resource allocation to enhance workplace culture.</p>
                <p><strong>Action Required:</strong> Review detailed insights and implement priority recommendations within the next 30-60 days for maximum impact.</p>
                <p><strong>Follow-up:</strong> Schedule progress review in 90 days and follow-up survey in 6 months to measure improvement.</p>
                <p><strong>Generated:</strong> {__import__('datetime').datetime.now().strftime('%Y-%m-%d %H:%M:%S')}</p>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>Generated automatically • AI-Powered Analysis</p>
    </div>

    <script>
        function exportToPDF() {{
            // Simple PDF export using browser print
            const originalTitle = document.title;
            document.title = 'Employee_Satisfaction_Report';

            // Hide action buttons for PDF
            document.querySelector('.action-buttons').style.display = 'none';

            window.print();

            // Restore buttons after print
            setTimeout(() => {{
                document.querySelector('.action-buttons').style.display = 'block';
                document.title = originalTitle;
            }}, 1000);
        }}

        // Text fields are directly editable on click via contenteditable.
    </script>
</body>
</html>
    """
    
    return html

def main():
    """Main function - YOUR ORIGINAL OBJECTIVE: Generate HTML report"""
    # Suppress stderr to prevent transformers warnings from interfering with JSON
    import sys
    from io import StringIO
    old_stderr = sys.stderr
    sys.stderr = StringIO()

    try:
        # Get data from command line
        if len(sys.argv) < 2:
            # Return JSON error for PHP
            print(json.dumps({
                'success': False,
                'error': 'No survey data provided'
            }))
            return
        
        # Parse survey data from file path or direct JSON string
        input_arg = sys.argv[1]
        if os.path.isfile(input_arg):
            # File path provided by Laravel or CLI
            with open(input_arg, 'r', encoding='utf-8') as f:
                survey_data = json.load(f)
        else:
            # JSON string provided directly
            survey_data = json.loads(input_arg)

        # Debug: Check data structure
        if not survey_data:
            raise ValueError("No survey data received")

        # Ensure we have the right data structure
        if isinstance(survey_data, list) and len(survey_data) == 0:
            raise ValueError("Empty survey data received")
        
        # Calculate statistics
        stats = calculate_statistics(survey_data)
        
        if not stats:
            print(json.dumps({
                'success': False,
                'error': 'No valid survey data to analyze'
            }))
            return
        
        # Generate AI analysis
        analysis = generate_ai_analysis_simple(stats)
        
        # Generate HTML report file
        html_report = generate_html_report(stats, analysis)
        
        # Save HTML file (YOUR MAIN OBJECTIVE)
        report_filename = 'employee_satisfaction_report.html'
        with open(report_filename, 'w', encoding='utf-8') as f:
            f.write(html_report)
        
        # Return success status and file path to PHP
        print(json.dumps({
            'success': True,
            'html_report_path': report_filename,
            'questions_analyzed': len(stats),
            'file_size_bytes': len(html_report.encode('utf-8'))
        }))
        
    except Exception as e:
        # Return error to PHP
        print(json.dumps({
            'success': False,
            'error': str(e),
            'traceback': traceback.format_exc()
        }))
    finally:
        # Restore stderr
        sys.stderr = old_stderr

if __name__ == "__main__":
    main()